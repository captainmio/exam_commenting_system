<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentTest extends TestCase
{
    public function testRequiredFieldsForAddingComment()
    {
        $commentData = [
        ];

        $this->json('POST', 'api/comment', $commentData, ['Accept' => 'application/json'])
        ->assertStatus(422)
        ->assertJson([
            "message" => "The given data was invalid.",
            "errors" => [
                "name" => ["The name field is required."],
                "body" => ["The body field is required."],
            ]
        ]);
    }


    public function testIncorrectParentIdValueDataType()
    {
        $commentData = [
            "name" => "John Doe",
            "parent_id" => "TEST",
            "body" => "Non irure dolore voluptate ut elit irure anim exercitation magna. Velit consequat aliquip consectetur aliqua labore fugiat enim veniam ullamco ullamco fugiat labore. Irure sint cupidatat non mollit exercitation labore dolore enim. Sunt anim voluptate pariatur nostrud amet velit consectetur officia veniam. Reprehenderit nulla sint voluptate in adipisicing. Voluptate qui nisi ex est veniam labore qui irure dolor Lorem magna minim consequat."
        ];

        $this->json('POST', 'api/comment', $commentData, ['Accept' => 'application/json'])
        ->assertStatus(422)
        ->assertJson([
            "message" => "The given data was invalid.",
            "errors" => [
                "parent_id" => ["The parent id must be a number."],
            ]
        ]);
    }


    public function testSuccessfulInsertingNewComment()
    {

        $commentData = [
            "name" => "John Doe",
            "parent_id" => 33,
            "body" => "Non irure dolore voluptate ut elit irure anim exercitation magna. Velit consequat aliquip consectetur aliqua labore fugiat enim veniam ullamco ullamco fugiat labore. Irure sint cupidatat non mollit exercitation labore dolore enim. Sunt anim voluptate pariatur nostrud amet velit consectetur officia veniam. Reprehenderit nulla sint voluptate in adipisicing. Voluptate qui nisi ex est veniam labore qui irure dolor Lorem magna minim consequat."
        ];

        $this->json('POST', 'api/comment', $commentData, ['Accept' => 'application/json'])
        ->assertStatus(200)
        ->assertJson([
            "success" => true
        ]);
    }


    public function testPullingOfDataByParentId()
    {

        $commentFactory = factory(\App\Comment::class)->create();

        $this->json('GET', 'api/comment/pullComments/'.$commentFactory->id, ['Accept' => 'application/json'])
        ->assertStatus(200);
    }


}
