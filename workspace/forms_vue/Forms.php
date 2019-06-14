<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 15.06.19
 * Time: 0:25
 */

namespace workspace\forms_vue;


class Forms
{
    public static function find($id)
    {
        if(method_exists(self::class, $id)){
            return self::$id();
        }
        return ['error' => 'form not found'];
    }

    public static function first()
    {
        return [
            'text' => [
                'id' => 'text',
                'label' => 'Текстовый инпут',
                'inputName' => 'text',
                'fieldName' => 'text',
                'placeholder' => 'Введите текст',
                'component' => 'BaseInput',
            ],
            'email' => [
                'id' => 'email',
                'label' => 'Email инпут',
                'inputName' => 'email',
                'fieldName' => 'email',
                'placeholder' => 'Введите email',
                'component' => 'BaseInputEmail',
            ]
        ];
    }

    public static function second()
    {
        return [
            'text' => [
                'id' => 'text',
                'label' => 'Текстовый инпут',
                'inputName' => 'text',
                'fieldName' => 'text',
                'placeholder' => 'Введите текст',
                'component' => 'BaseInput',
            ],
            'email' => [
                'id' => 'email',
                'label' => 'Email инпут',
                'inputName' => 'email',
                'fieldName' => 'email',
                'placeholder' => 'Введите email',
                'component' => 'BaseInputEmail',
            ],
            'checkbox1' => [
                'id' => 'checkbox1',
                'label' => 'Чекбокс 1',
                'inputName' => 'checkbox',
                'fieldName' => 'checkbox',
                'value' => 'Василий',
                'component' => 'BaseCheckbox',
            ]
        ];
    }

}