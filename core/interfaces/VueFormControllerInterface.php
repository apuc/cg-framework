<?php


namespace core\interfaces;

interface VueFormControllerInterface
{
    public function create();
    public function update($id);
    public function show($id);
    public function index();
    public function delete($id);
}