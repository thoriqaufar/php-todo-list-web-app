<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodolistControllerTest extends TestCase
{
    public function testTodolist()
    {
        $this->withSession([
            "user" => "thoriq",
            "todolist" => [
                "id" => "1",
                "todo" => "Thoriq"
            ]
        ])->get('/todolist')
            ->assertSeeText("1")
            ->assertSeeText("Thoriq");
    }

    public function testAddTodoFailed()
    {
        $this->withSession([
            "user" => "thoriq",
        ])->post("/todolist", [])
            ->assertSeeText("Todo is required");
    }

    public function testAddTodoSuccess()
    {
        $this->withSession([
            "user" => "thoriq"
        ])->post("/todolist", [
            "todo" => "Thoriq"
        ])->assertRedirect("/todolist");
    }

    public function testRemoveTodolist()
    {
        $this->withSession([
            "user" => "thoriq",
            "todolist" => [
                [
                    "id" => "1",
                    "todo" => "Thoriq"
                ]
            ]
        ])->post("/todolist/1/delete")
            ->assertRedirect("/todolist");
    }


}
