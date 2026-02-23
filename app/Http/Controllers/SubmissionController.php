<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use App\Models\Form;
use App\Models\Ticket;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SubmissionController extends CrudController
{
    protected function model(): string { return Submission::class; }

    public function list(Request $request): JsonResponse
    {
        $items = Submission::with('form:id,name')->orderBy('created_at', 'desc')->get();

        $enriched = $items->map(function ($sub) {
            $data = self::formatItem($sub);
            if ($sub->form) {
                $data['form'] = $sub->form->name;
                $data['formId'] = (string) $sub->form->id;
            }
            unset($data['form_id']); // remove raw FK from output
            return $data;
        });

        return response()->json($enriched->values()->toArray());
    }

    public function getById(string $id): JsonResponse
    {
        $sub = Submission::with('form:id,name')->find($id);
        if (!$sub) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $data = self::formatItem($sub);
        if ($sub->form) {
            $data['form'] = $sub->form->name;
            $data['formId'] = (string) $sub->form->id;
        }

        return response()->json($data);
    }

    public function create(Request $request): JsonResponse
    {
        $item = Submission::create($this->parseInput($request->all()));

        // Auto-create a ticket
        try {
            $bodyData = $request->input('data', []);
            $name = $bodyData['name'] ?? $bodyData['fullName'] ?? 'Website Visitor';
            $email = $bodyData['email'] ?? '';
            $subject = $bodyData['subject'] ?? 'Form Submission';
            $message = $bodyData['message'] ?? $bodyData['description'] ?? '';

            if (empty($message)) {
                $pieces = [];
                foreach ($bodyData as $k => $v) {
                    if (!str_starts_with($k, '_') && is_string($v)) {
                        $pieces[] = "$k: $v";
                    }
                }
                $message = implode("\n", $pieces);
            }

            Ticket::create([
                'subject' => $subject,
                'description' => $message,
                'full_name' => $name,
                'email' => $email,
                'priority' => 'medium',
                'status' => 'open',
            ]);
        } catch (\Throwable $e) {
            // Silent fail — ticket creation is best-effort
        }

        return response()->json(self::formatItem($item), 201);
    }
}
