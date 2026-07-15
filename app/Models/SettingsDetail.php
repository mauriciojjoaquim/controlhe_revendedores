<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SettingsDetail extends Model
{
    protected $fillable = [
        'cor_id',
        'pix',
        'text_color',
        'text_color_site',
        'bg_color_site',
        'color_site_bg',
        'bg_color_menu',
        'color_menu_vertical_text',
        'bg_color_table',
        'color_table_text',
        'color_card_bg',
        'clor_card_text',
        'color_border',
        'percentage',
        'price',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}