<?php

namespace Zaoob\Laravel\Tokenable\Traits;

use Zaoob\Laravel\Tokenable\Models\Token;

trait HasZaoobToken
{
    public function getTokensAttribute()
    {
        return $this->morphMany(Token::class, 'modelable')->get();
    }

    public function createToken(string $name = null)
    {
        return $this->morphOne(Token::class, 'modelable')->create([
            'name' => $name,
            'token' => md5(time()),
        ]);
    }
}
