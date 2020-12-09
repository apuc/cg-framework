<?php

namespace core;

class FormGen
{
    protected $method;

    protected $action;

    protected $enctype;

    protected $chunks = [];

    protected $errors = null;

    protected $data;

    protected $inputTemplate = 0;

    protected $customInputTemplate;

    protected $openForm = 0;

    protected $closeForm = 0;

    public static function factory()
    {
        return new self();
    }

    public function form($method = 'GET', $action = '')
    {
        $this->openForm = 1;
        $this->method = $method;
        $this->action = $action;
        return $this;
    }

    public function upload()
    {
        $this->enctype = 'multipart/form-data';
        return $this;
    }

    public function addLabel($title, $for = '', $class = '')
    {
        $this->chunks[] = [
            'type' => 'label',
            'title' => $title,
            'for' => $for,
            'class' => $class,
        ];
        return $this;
    }

    public function addField($type, $name, $class = '')
    {
        $this->chunks[] = [
            'type' => $type,
            'name' => $name,
            'class' => $class,
            'template' => $this->inputTemplate,
            'custom_tpl' => $this->customInputTemplate,
        ];
        return $this;
    }

    public function addText($name, $class)
    {
        $this->addField('text', $name, $class);
        return $this;
    }

    public function addPassword($name, $class)
    {
        $this->addField('password', $name, $class);
        return $this;
    }

    public function addFile($name, $class)
    {
        $this->addField('file', $name, $class);
        return $this;
    }

    public function addHidden($name, $class)
    {
        $this->addField('hidden', $name, $class);
        return $this;
    }

    public function addSelect($name, $options, $class = '')
    {
        $this->chunks[] = [
            'type' => 'select',
            'name' => $name,
            'options' => $options,
            'class' => $class,
            'template' => $this->inputTemplate,
            'custom_tpl' => $this->customInputTemplate,
        ];
        return $this;
    }

    public function addRadio($name, $value, $text)
    {
        $this->chunks[] = [
            'type' => 'radio',
            'name' => $name,
            'value' => $value,
            'class' => $text,
            'template' => $this->inputTemplate,
            'custom_tpl' => $this->customInputTemplate,
        ];
        return $this;
    }

    public function addCheckbox($name, $text)
    {
        $this->chunks[] = [
            'type' => 'checkbox',
            'name' => $name,
            'text' => $text,
            'template' => $this->inputTemplate,
            'custom_tpl' => $this->customInputTemplate,
        ];
        return $this;
    }

    public function addTextarea($name, $class='')
    {
        $this->chunks[] = [
            'type' => 'textarea',
            'name' => $name,
            'class' => $class,
            'template' => $this->inputTemplate,
            'custom_tpl' => $this->customInputTemplate,
        ];
        return $this;
    }

    public function addSubmit($value, $class)
    {
        $this->chunks[] = [
            'type' => 'submit',
            'value' => $value,
            'class' => $class,
            'template' => $this->inputTemplate,
            'custom_tpl' => $this->customInputTemplate,
        ];
        return $this;
    }

    public function addWidget($code)
    {
        $this->chunks[] = [
            'type' => 'widget',
            'code' => $code,
            'template' => $this->inputTemplate,
            'custom_tpl' => $this->customInputTemplate,
        ];
        return $this;
    }

    public function addData($data)
    {
        $this->data = $data;
        return $this;
    }

    public function addErrors($errors)
    {
        $this->errors = $errors;
        return $this;
    }

    public function closeForm()
    {
        $this->closeForm = 1;
        return $this;
    }

    public function activeInputTemplate()
    {
        $this->inputTemplate = 1;
        return $this;
    }

    public function deactiveInputTemplate()
    {
        $this->inputTemplate = 0;
        $this->customInputTemplate = null;
        return $this;
    }

    public function setInputWrapperTemplate($template)
    {
        $this->customInputTemplate = $template;
        return $this;
    }

    public function inputWrapperTemplate($field, $enabledTpl = 0, $template = '')
    {
        if (!empty($template) || $enabledTpl) {
            if (!empty($template)) {
                $template = $template;
            } else {
                $template = '<div class="input-group">{field}</div>';
            }
            return str_replace('{field}', $field, $template);
        } else {
            return $field;
        }
    }

    protected function HtmlErrorTemplate($error)
    {
        $template = '<div class="error">{error}</div>';
        return str_replace('{error}', $error, $template);
    }

    public function get($display = 0)
    {
        if (!empty($this->action)) {
            $action = ' action="' . $this->action . '"';
        }

        $out = '';
        if ($this->openForm == 1) {
            $enctype = (!empty($this->enctype)) ? ' enctype="'. $this->enctype .'"': '';
            $out .=  '<form method="'.$this->method.'"'.$action.$enctype .'>';
            $this->openForm = 0;
        }
        foreach ($this->chunks as $chunk) {
            $error = null;
            $htmlObject = '';

            $chunkName = $chunk['name'] ?? '';
            $error = $this->errors[$chunkName] ?? '';
            $data = $this->data[$chunkName] ?? '';
            if ($error) {
                $error = $this->HtmlErrorTemplate($this->errors[$chunkName]);
            }

            if ($chunk['type'] == 'widget') {
                $out .= $chunk['code'];
            }


            if ($chunk['type'] == 'label') {

                $out .= '<label for='.$chunk['for'].' class="'.$chunk['class'].'">'
                        .$chunk['title'].'</label>';
            }

            if ($chunk['type'] == 'textarea') {
                $htmlObject .= '<textarea name="'.$chunkName.'">'.$data.'</textarea>';
            }

            if ($chunk['type'] == 'select') {
                $htmlObject = '<select name="'.$chunk['name'].'">';
                $htmlObject .= '<option></option>';
                foreach ($chunk['options'] as $option => $name) {
                    $selected = ($data == $option) ?
                        ' selected' : '';
                    $htmlObject .= '<option value="'.$option.'"'.$selected.'>'
                        .$name.
                        '</option>';
                }
                $htmlObject .= '</select>';
            }

            if ($chunk['type'] == 'checkbox') {
                $checked = ($data == 1) ? ' checked' : '';
                $htmlObject .=
                    '<input type="checkbox" name="'.$chunkName.
                    '" value="1" '.$checked.' />' .$chunk['text'];
            }

            if ($chunk['type'] == 'radio') {
                $checked = ($data == $chunk['value']) ? ' checked' : '';
                $htmlObject .= '<input name="'.$chunkName.'" type="radio" value="'.
                    $chunk['value'].'"'.$checked.'>' . $chunk['text'];
            }

            if ($chunk['type'] == 'submit') {
                $htmlObject .= '<input class="'.$chunk['class']
                    .'" type="submit" value="'.$chunk['value'].'"  />';
            }

            $types = ['text', 'password', 'file', 'hidden'];
            if (in_array($chunk['type'], $types)) {
                $htmlObject .= '<input class="'.$chunk['class'].'" type="'.$chunk['type'].
                    '" name="'.$chunk['name'].'" value="'. $data.'" />';
            }

            $types = [
                'text', 'password', 'file', 'radio', 'checkbox',
                'select', 'textarea', 'widget'
            ];
            if (in_array($chunk['type'], $types)) {
                $out .= $this->inputWrapperTemplate($htmlObject, $chunk['template'], $chunk['custom_tpl']) . $error;
            }
        }

        if ($this->closeForm == 1) {
            $out .= "</form>";
        }

        if ($display == 1) {
            echo $out;
        }
        return $out;
    }
}