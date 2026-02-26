<?php

namespace App\Helpers;

/**
 * Public response mappers — exact 1:1 match with Express.js public-mappers.ts
 * Express uses _id and snake_case for API response field names.
 */
class PublicMapper
{
    private static function shouldForceHttps(): bool
    {
        $forceHttps = filter_var(env('FORCE_HTTPS', false), FILTER_VALIDATE_BOOL);
        return $forceHttps || app()->environment('production');
    }

    public static function resolveUrl(?string $path): string
    {
        if (!$path) return '';

        $forceHttps = self::shouldForceHttps();
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $forceHttps ? preg_replace('/^http:\/\//i', 'https://', $path) : $path;
        }

        $normalizedPath = str_starts_with($path, '/') ? $path : '/' . ltrim($path, '/');
        $baseUrl = rtrim((string) config('app.url', ''), '/');

        if ($baseUrl === '' && app()->bound('request')) {
            $baseUrl = rtrim((string) request()->getSchemeAndHttpHost(), '/');
        }

        if ($baseUrl === '') {
            return $normalizedPath;
        }

        if ($forceHttps) {
            $baseUrl = preg_replace('/^http:\/\//i', 'https://', $baseUrl);
        }

        return $baseUrl . $normalizedPath;
    }

    public static function mapBrand($b): array
    {
        if (!$b) return [];
        $socials = is_array($b->social_links) ? $b->social_links : [];
        return [
            '_id' => (string) $b->id,
            'company_name_en' => $b->company_name ?? '',
            'company_name_ne' => $b->company_name ?? '',
            'tagline_en' => $b->tagline ?? '',
            'tagline_ne' => $b->tagline ?? '',
            'logo_url' => self::resolveUrl($b->logo_url ?? ''),
            'favicon_url' => self::resolveUrl($b->favicon_url ?? ''),
            'address_en' => $b->office_address ?? '',
            'address_ne' => $b->office_address ?? '',
            'emails' => is_array($b->emails) ? $b->emails : [],
            'phones' => is_array($b->phone_numbers) ? $b->phone_numbers : [],
            'socials' => array_map(fn($item) => [
                'platform' => $item['platform'] ?? '',
                'label' => $item['platform'] ?? '',
                'url' => $item['url'] ?? '',
            ], $socials),
            'whatsapp_number' => $b->whatsapp_number ?? '',
            'whatsapp_message_en' => $b->whatsapp_message ?? '',
            'whatsapp_message_ne' => $b->whatsapp_message ?? '',
            'whatsapp_enabled' => $b->whatsapp_enabled !== false,
            'chatbot_greeting_en' => $b->chatbot_greeting ?? '',
            'chatbot_greeting_ne' => $b->chatbot_greeting ?? '',
            'chairman_name' => $b->chairman_name ?? '',
            'chairman_photo_url' => self::resolveUrl($b->chairman_photo_url ?? ''),
            'chairman_message_en' => $b->chairman_message_en ?? '',
            'chairman_message_ne' => $b->chairman_message_ne ?? '',
            'signature_url' => self::resolveUrl($b->signature_url ?? ''),
            'registration_info_en' => $b->registration_info_en ?? '',
            'registration_info_ne' => $b->registration_info_ne ?? '',
            'footer_summary_en' => $b->footer_summary_en ?? '',
            'footer_summary_ne' => $b->footer_summary_ne ?? '',
            'license_number' => $b->license_number ?? '',
            'registration_number' => $b->registration_number ?? '',
            'pan_number' => $b->pan_number ?? '',
            'capital_amount' => $b->capital_amount ?? '',
            'bank_name' => $b->bank_name ?? '',
            'google_map_embed' => $b->google_map_embed ?? '',
            'about_us_en' => $b->about_us_en ?? '',
            'about_us_ne' => $b->about_us_ne ?? '',
            'vision_en' => $b->vision_en ?? '',
            'vision_ne' => $b->vision_ne ?? '',
            'mission_en' => $b->mission_en ?? '',
            'mission_ne' => $b->mission_ne ?? '',
            'objectives_en' => is_array($b->objectives_en) ? $b->objectives_en : [],
            'objectives_ne' => is_array($b->objectives_ne) ? $b->objectives_ne : [],
            'primary_color' => $b->primary_color ?? '#038441',
            'secondary_color' => $b->secondary_color ?? '#026B34',
            'accent_color' => $b->accent_color ?? '#D4AF37',
            'light_bg_color' => $b->light_bg_color ?? '#F0F7F2',
            'dark_footer_color' => $b->dark_footer_color ?? '#012A15',
            'registered_with_en' => $b->registered_with_en ?? '',
            'registered_with_ne' => $b->registered_with_ne ?? '',
            'for_employers_intro_en' => $b->for_employers_intro_en ?? '',
            'for_employers_intro_ne' => $b->for_employers_intro_ne ?? '',
        ];
    }

    public static function mapHero($h): array
    {
        if (!$h) return [];
        $counters = is_array($h->counters) ? $h->counters : [];
        return [
            '_id' => (string) $h->id,
            'headline_en' => $h->headline_en ?? '',
            'headline_ne' => $h->headline_ne ?? '',
            'subheadline_en' => $h->subheadline_en ?? '',
            'subheadline_ne' => $h->subheadline_ne ?? '',
            'background_type' => $h->background_type ?? 'image',
            'background_url' => self::resolveUrl($h->background_url ?? ''),
            'cta_primary_label_en' => $h->cta_primary_label_en ?? '',
            'cta_primary_label_ne' => $h->cta_primary_label_ne ?? '',
            'cta_primary_link' => $h->cta_primary_link ?? '',
            'cta_secondary_label_en' => $h->cta_secondary_label_en ?? '',
            'cta_secondary_label_ne' => $h->cta_secondary_label_ne ?? '',
            'cta_secondary_link' => $h->cta_secondary_link ?? '',
            'show_counters' => $h->show_counters !== false,
            'counters' => array_map(fn($item) => [
                'key' => $item['key'] ?? '',
                'label_en' => $item['label_en'] ?? '',
                'label_ne' => $item['label_ne'] ?? '',
                'value' => $item['value'] ?? 0,
                'suffix' => $item['suffix'] ?? '',
            ], $counters),
        ];
    }

    public static function mapMenu($m): array
    {
        return [
            '_id' => (string) $m->id,
            'label_en' => $m->label_en ?? '',
            'label_ne' => $m->label_ne ?? '',
            'href' => $m->url ?? '',
            'order' => $m->order_index ?? 0,
            'enabled' => $m->is_enabled !== false,
            'isExternal' => $m->is_external === true,
            'target' => $m->target ?? '_self',
            'location' => $m->location ?? 'navbar',
            'parentId' => $m->parent_id,
        ];
    }

    public static function mapService($s): array
    {
        return [
            '_id' => (string) $s->id,
            'icon' => $s->icon ?? '',
            'title_en' => $s->title_en ?? '',
            'title_ne' => $s->title_ne ?? '',
            'description_en' => $s->description_en ?? '',
            'description_ne' => $s->description_ne ?? '',
            'orderIndex' => $s->order_index ?? 0,
            'isActive' => $s->is_active !== false,
        ];
    }

    public static function mapJob($j): array
    {
        return [
            '_id' => (string) $j->id,
            'slug' => $j->slug,
            'title_en' => $j->title_en,
            'title_ne' => $j->title_ne,
            'description_en' => $j->description_en,
            'description_ne' => $j->description_ne,
            'category' => $j->category,
            'country' => $j->country,
            'salaryMin' => $j->salary_min,
            'salaryMax' => $j->salary_max,
            'currency' => $j->currency,
            'requirements_en' => $j->requirements_en,
            'requirements_ne' => $j->requirements_ne,
            'deadline' => $j->deadline,
            'isFeatured' => $j->is_featured === true,
            'employer' => $j->employer ?? '',
        ];
    }

    public static function mapCountry($c): array
    {
        return [
            '_id' => (string) $c->id,
            'slug' => $c->slug,
            'code' => $c->code ?? '',
            'flagUrl' => self::resolveUrl($c->flag_url ?? ''),
            'name_en' => $c->name_en,
            'name_ne' => $c->name_ne,
            'visaInfo_en' => $c->visa_info_en,
            'visaInfo_ne' => $c->visa_info_ne,
            'demandSectors_en' => is_array($c->demand_sectors_en) ? $c->demand_sectors_en : [],
            'demandSectors_ne' => is_array($c->demand_sectors_ne) ? $c->demand_sectors_ne : [],
            'salaryRange_en' => $c->salary_range_en,
            'salaryRange_ne' => $c->salary_range_ne,
            'requirements_en' => $c->requirements_en,
            'requirements_ne' => $c->requirements_ne,
            'isActive' => $c->is_active !== false,
        ];
    }

    public static function mapSponsor($s): array
    {
        return [
            '_id' => (string) $s->id,
            'logoUrl' => self::resolveUrl($s->logo_url ?? ''),
            'name' => $s->name ?? '',
            'industry' => $s->industry ?? '',
            'description_en' => $s->description_en ?? '',
            'description_ne' => $s->description_ne ?? '',
            'country' => $s->country ?? '',
            'activeJobs' => $s->active_jobs ?? 0,
            'isActive' => $s->is_active !== false,
        ];
    }

    public static function mapGallery($g): array
    {
        return [
            '_id' => (string) $g->id,
            'title_en' => $g->title_en,
            'title_ne' => $g->title_ne,
            'caption_en' => $g->caption_en,
            'caption_ne' => $g->caption_ne,
            'mediaUrl' => self::resolveUrl($g->media_url),
            'mediaType' => $g->media_type,
            'category' => $g->category,
            'orderIndex' => $g->order_index ?? 0,
            'isActive' => $g->is_active !== false,
        ];
    }

    public static function mapSuccessStory($s): array
    {
        return [
            '_id' => (string) $s->id,
            'candidateName' => $s->candidate_name,
            'photoUrl' => self::resolveUrl($s->photo_url),
            'countryDeployed' => $s->country_deployed,
            'jobTitle_en' => $s->job_title_en,
            'jobTitle_ne' => $s->job_title_ne,
            'story_en' => $s->story_en,
            'story_ne' => $s->story_ne,
            'deployedDate' => $s->deployed_date,
            'orderIndex' => $s->order_index ?? 0,
            'isActive' => $s->is_active !== false,
        ];
    }

    public static function mapTestimonial($t): array
    {
        return [
            '_id' => (string) $t->id,
            'candidateName' => $t->candidate_name,
            'photoUrl' => self::resolveUrl($t->photo_url),
            'countryDeployed' => $t->country_deployed,
            'review_en' => $t->review_en,
            'review_ne' => $t->review_ne,
            'rating' => $t->rating,
            'orderIndex' => $t->order_index ?? 0,
            'isActive' => $t->is_active !== false,
        ];
    }

    public static function mapNotice($n): array
    {
        return [
            '_id' => (string) $n->id,
            'type' => $n->type ?? 'general',
            'title_en' => $n->title_en ?? '',
            'title_ne' => $n->title_ne ?? '',
            'description_en' => $n->description_en ?? '',
            'description_ne' => $n->description_ne ?? '',
            'imageUrl' => self::resolveUrl($n->image_url ?? ''),
            'pdfUrl' => self::resolveUrl($n->pdf_url ?? $n->attachment_url ?? ''),
            'attachmentUrl' => self::resolveUrl($n->attachment_url ?? ''),
            'publishDate' => $n->publish_date,
            'isPopup' => $n->is_popup === true,
            'targetPages' => is_array($n->target_pages) ? $n->target_pages : [],
        ];
    }

    public static function mapForm($f): array
    {
        $fields = is_array($f->fields) ? $f->fields : [];
        return [
            '_id' => (string) $f->id,
            'name' => $f->name ?? '',
            'slug' => $f->slug ?? '',
            'description_en' => $f->description_en ?? '',
            'description_ne' => $f->description_ne ?? '',
            'isActive' => $f->is_active !== false,
            'fields' => array_map(function ($field) {
                $options = is_array($field['options'] ?? null) ? $field['options'] : [];
                return [
                    '_id' => $field['_id'] ?? $field['id'] ?? null,
                    'key' => $field['key'] ?? $field['name'] ?? '',
                    'name' => $field['key'] ?? $field['name'] ?? '',
                    'type' => $field['type'] ?? '',
                    'label_en' => $field['label_en'] ?? '',
                    'label_ne' => $field['label_ne'] ?? '',
                    'required' => ($field['required'] ?? false) === true,
                    'options' => array_map(fn($opt) => [
                        'value' => $opt,
                        'label_en' => $opt,
                        'label_ne' => $opt,
                    ], $options),
                ];
            }, $fields),
        ];
    }

    public static function mapPage($p): array
    {
        return [
            '_id' => (string) $p->id,
            'slug' => $p->slug,
            'title_en' => $p->title_en,
            'title_ne' => $p->title_ne,
            'content_en' => $p->content_en,
            'content_ne' => $p->content_ne,
            'seo' => [
                'title_en' => $p->seo_title_en ?? '',
                'title_ne' => $p->seo_title_ne ?? '',
                'description_en' => $p->seo_description_en ?? '',
                'description_ne' => $p->seo_description_ne ?? '',
                'og_image' => self::resolveUrl($p->og_image ?? ''),
                'keywords' => is_array($p->keywords ?? null) ? $p->keywords : [],
            ],
        ];
    }

    public static function mapTheme($t): array
    {
        return [
            '_id' => (string) $t->id,
            'mode' => $t->mode ?? 'light',
            'primary_color' => $t->primary_color ?? '',
            'secondary_color' => $t->secondary_color ?? '',
            'logo_url' => self::resolveUrl($t->logo_url ?? ''),
            'favicon_url' => self::resolveUrl($t->favicon_url ?? ''),
            'isDefault' => $t->is_default === true,
        ];
    }

    public static function mapTranslation($t): array
    {
        return [
            '_id' => (string) $t->id,
            'namespace' => $t->namespace ?? '',
            'key' => $t->key ?? '',
            'en' => $t->en ?? '',
            'ne' => $t->ne ?? '',
        ];
    }

    public static function mapChatbot($c): array
    {
        return [
            '_id' => (string) $c->id,
            'category' => $c->category,
            'question_en' => $c->question_en,
            'question_ne' => $c->question_ne,
            'answer_en' => $c->answer_en,
            'answer_ne' => $c->answer_ne,
            'isActive' => $c->is_active !== false,
        ];
    }

    public static function mapOrganizationStructure($o): array
    {
        return [
            '_id' => (string) $o->id,
            'name' => $o->name ?? '',
            'designation_en' => $o->designation_en ?? '',
            'designation_ne' => $o->designation_ne ?? '',
            'photo_url' => $o->photo_url ?? '',
            'bio_en' => $o->bio_en ?? '',
            'bio_ne' => $o->bio_ne ?? '',
            'department' => $o->department ?? '',
            'display_order' => $o->display_order ?? 0,
        ];
    }

    public static function mapRecruitmentProcess($r): array
    {
        return [
            '_id' => (string) $r->id,
            'step_number' => $r->step_number ?? 0,
            'title_en' => $r->title_en ?? '',
            'title_ne' => $r->title_ne ?? '',
            'description_en' => $r->description_en ?? '',
            'description_ne' => $r->description_ne ?? '',
            'icon' => $r->icon ?? '',
            'display_order' => $r->display_order ?? 0,
        ];
    }

    public static function mapCategory($c): array
    {
        $positions = is_array($c->positions) ? $c->positions : [];
        return [
            '_id' => (string) $c->id,
            'name_en' => $c->name_en ?? '',
            'name_ne' => $c->name_ne ?? '',
            'slug' => $c->slug ?? '',
            'description_en' => $c->description_en ?? '',
            'description_ne' => $c->description_ne ?? '',
            'icon' => $c->icon ?? '',
            'image_url' => $c->image_url ?? '',
            'sector_type' => $c->sector_type ?? 'general',
            'positions' => array_map(fn($p) => [
                'title_en' => $p['title_en'] ?? '',
                'title_ne' => $p['title_ne'] ?? '',
            ], $positions),
            'display_order' => $c->display_order ?? 0,
        ];
    }

    public static function mapLegalDocument($d): array
    {
        return [
            '_id' => (string) $d->id,
            'title_en' => $d->title_en ?? '',
            'title_ne' => $d->title_ne ?? '',
            'description_en' => $d->description_en ?? '',
            'description_ne' => $d->description_ne ?? '',
            'document_url' => $d->document_url ?? '',
            'document_type' => $d->document_type ?? 'license',
            'issue_authority_en' => $d->issue_authority_en ?? '',
            'issue_authority_ne' => $d->issue_authority_ne ?? '',
            'issue_date' => $d->issue_date,
            'expiry_date' => $d->expiry_date,
            'reference_number' => $d->reference_number ?? '',
            'display_order' => $d->display_order ?? 0,
        ];
    }

    public static function mapEmployerRequirement($r): array
    {
        return [
            '_id' => (string) $r->id,
            'document_name_en' => $r->document_name_en ?? '',
            'document_name_ne' => $r->document_name_ne ?? '',
            'description_en' => $r->description_en ?? '',
            'description_ne' => $r->description_ne ?? '',
            'is_required' => $r->is_required !== false,
            'category' => $r->category ?? 'general',
            'display_order' => $r->display_order ?? 0,
        ];
    }

    public static function mapPageSection($s): array
    {
        return [
            '_id' => (string) $s->id,
            'page_slug' => $s->page_slug ?? '',
            'section_key' => $s->section_key ?? '',
            'section_type' => $s->section_type ?? 'text',
            'title_en' => $s->title_en ?? '',
            'title_ne' => $s->title_ne ?? '',
            'subtitle_en' => $s->subtitle_en ?? '',
            'subtitle_ne' => $s->subtitle_ne ?? '',
            'content_en' => $s->content_en ?? '',
            'content_ne' => $s->content_ne ?? '',
            'items' => is_array($s->items) ? $s->items : [],
            'sort_order' => $s->sort_order ?? 0,
            'is_active' => $s->is_active !== false,
        ];
    }
}
