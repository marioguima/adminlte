<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'value',
    ];

    protected $appends = [
        'type_name',
        'whatsapp_markdown_to_html',
    ];

    /**
     * Obter o nome do tipo
     * 
     * @return string
     */
    public function getTypeNameAttribute()
    {
        $name = '';
        if ($this->type = 'text') {
            $name = 'Texto';
        } elseif ($this->type = 'image') {
            $name = 'imagem';
        } elseif ($this->type = 'document') {
            $name = 'Documento';
        } elseif ($this->type = 'video') {
            $name = 'Vídeo';
        } elseif ($this->type = 'audio') {
            $name = 'Áudio';
        } elseif ($this->type = 'contact') {
            $name = 'Contato';
        }
        return $name;
    }

    /**
     * Convert markdown whatsapp para html
     * 
     * @return string
     */
    public function getWhatsappMarkdownToHtmlAttribute()
    {
        // Bold
        $re = '/(\*)([^*]+?)(\1)/m';
        $str = $this->value;
        $subst = '<strong>$2</strong>';
        $result = preg_replace($re, $subst, $str);

        // Italic
        $re = '/(_)([^_]+?)(\1)/m';
        $str = $result;
        $subst = '<em>$2</em>';
        $result = preg_replace($re, $subst, $str);

        // Strike (riscado)
        $re = '/(\~)([^~]+?)(\1)/m';
        $str = $result;
        $subst = '<strike>$2</strike>';
        $result = preg_replace($re, $subst, $str);

        // Italic
        $re = '/(\```)([^```]+?)(\1)/m';
        $str = $result;
        $subst = '<code>$2</code>';
        $result = preg_replace($re, $subst, $str);

        // newline
        $result = str_replace("\r\n", "<br/>", $result);

        return $result;
    }
    
}
