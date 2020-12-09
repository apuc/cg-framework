<?php

namespace core;


class VueForm
{

    public static function find($id)
    {
        if(method_exists(static::class, $id)){
            return static::$id();
        }
        return ['error' => 'form not found'];
    }


    public static function form(){
        return [
            'accept-charset' => 'utf-8',
            'action' => 'action.php',
            'autocomplete' => 'on',             // on | off
            'enctype' => 'text/plain',
            'method' => 'get',                  // get | post
            'name' => 'formName',
            'novalidate' => '',
            'target' => '_self',
            'attributes' => [
                'accept' => 'image/jpeg,image/png,image/gif',
                'accesskey' => 'c',
                'align' => 'middle',
                'alt' => 'Отправить форму на сервер',
                'autocomplete' => 'on',
                'autofocus' => '',
                'border' => '2',
                'checked' => '',
                'disabled' => '',
                'form' => 'form_id',
                'formaction' => 'handler.php',
                'formenctype' => 'application/x-www-form-urlencoded',
                'formmethod' => 'post',
                'formnovalidate' => '',
                'formtarget' => '_blank',
                'list' => 'datalist_id',
                'max' => '1337',
                'maxlength' => '27',
                'min' => '18',
                'multiple' => '',
                'name' => 'input_name',
                'pattern' => '2-[0-9]{3}-[0-9]{3}',
                'placeholder' => 'Введите текст для поиска',
                'readonly' => '',
                'required' => '',
                'size' => '21',
                'src' => 'https://filmdaily.co/wp-content/uploads/2020/04/cute-cat-videos-lede.jpg',
                'step' => '2',
                'tabindex' => '7',
                'type' => 'button',
                'value' => 'a1',

                //Унинерсальные атрибуты
                'class' => 'cite',
                'contenteditable' => 'true',
                'contextmenu' => 'context_id',
                'dir' => 'ltr',
                'hidden' => '',
                'id' => 'element_id',
                'lang' => 'en',
                'spellcheck' => 'false',
                'style' => 'color: red; font-size: 2em',
                'title' => 'Любая текстовая строка',
                'xml:lang' => 'zh',

                //События
                'onblur' => 'script.php',
                'onchange' => 'document.location=this.options[this.selectedIndex].value',
                'onclick' => 'isEmail()', //JS-script
                'ondblclick' => 'colorDiv()',
                'onfocus' => 'this.value=7',
                'onkeydown' => 'script.php',
                'onkeypress' => 'script.js',
                'onkeyup' => 'another.script',
                'onload' => 'loadPage()',
                'onmousedown' => 'script()',
                'onmousemove' => 'mouseCoords(event)',
                'onmouseout' => 'resize(this, 100, 111)',
                'onmouseover' => 'this.src=\'images/graph1.png\'',
                'onmouseup' => 'if(window.interval) clearInterval(interval)',
                'onreset' => 'return confirm(\'Очистить форму?\')',
                'onselect' => 'alert(\'Выделен текст\')',
                'onsubmit' => 'deleteName(this);return false;',
                'onunload' => 'alert(\'Уже уходишь?\')'
            ]
        ];
    }
}