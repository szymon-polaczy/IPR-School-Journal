<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    protected $base_route = null;
    protected $base_model = null;

//todo: in git someone was talking about creating / testing auth()->user() was bad
//todo: my routes are bad - do i change mines to this or this to mine
//todo: am i sure my models can be created empty?
//todo: signIn would't it be better if I specify that instead of creating a user i should create an admin, student, teacher or something else
//todo: change the xml file to work with an in memory datbase
//todo: do my route responses send back json? there are assertions to json
//todo: will this work for testing a user creation? i need to create two models

    protected function signIn($user = null)
    {
        $user = $user ?? create(\App\User::class);
        $this->actingAs($user);
        return $this;
    }

    protected function setBaseRoute($route)
    {
        $this->base_route = $route;
    }

    protected function setBaseModel($model)
    {
        $this->base_model = $model;
    }

    protected function create($attributes = [], $model = '', $route = '')
    {
        $this->withoutExceptionHandling();

        $route = $this->base_route ? "{$this->base_route}.store" : $route;
        $model = $this->base_model ?? $model;

        $attributes = raw($model, $attributes);

        if (! auth()->user()) {
            $this->expectException(\Illuminate\Auth\AuthenticationException::class);
        }

        $response = $this->postJson(route($route), $attributes)->assertSuccessful();

        $model = new $model;

        $this->assertDatabaseHas($model->getTable(), $attributes);

        return $response;
    }

    protected function update($attributes = [], $model = '', $route = '')
    {
        $this->withoutExceptionHandling();

        $route = $this->base_route ? "{$this->base_route}.update" : $route;
        $model = $this->base_model ?? $model;

        $model = create($model);

        if (! auth()->user()) {
            $this->expectException(\Illuminate\Auth\AuthenticationException::class);
        }

        $response = $this->patchJson(route($route, $model->id), $attributes);

        tap($model->fresh(), function ($model) use ($attributes) {
            collect($attributes)->each(function($value, $key) use ($model) {
                $this->assertEquals($value, $model[$key]);
            });
        });

        return $response;
    }

    protected function destroy($model = '', $route = '')
    {
        $this->withoutExceptionHandling();

        $route = $this->base_route ? "{$this->base_route}.destroy" : $route;
        $model = $this->base_model ?? $model;

        $model = create($model);

        if (! auth()->user()) {
            $this->expectException(\Illuminate\Auth\AuthenticationException::class);
        }

        $response = $this->deleteJson(route($route, $model->id));

        $this->assertDatabaseMissing($model->getTable(), $model->toArray());

        return $response;
    }

    public function multipleDelete ($model = '', $route = '')
    {
        $this->withoutExceptionHandling();

        $route = $this->base_route ? "{$this->base_route}.destroyAll" : $route;
        $model = $this->base_model ?? $model;

        $model = create($model, [], 5);

        $ids = $model->map(function ($item, $key) {
            return $item->id;
        });

        return $this->deleteJson(route($route), ['ids' => $ids ]);
    }
}
