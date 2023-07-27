<?php

namespace App\Http\Controllers\Interfaces\Admin;

use Illuminate\Http\Request;

interface PetBreedControllerInterface
{
    public function index();
    public function getPetTypes();
    public function store(Request $request);
    public function update(Request $request);
    public function validatePetBreed($request);
    public function delete(Request $request);
    public function getId(Request $request);
}