<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
Use Uspdev\SenhaunicaSocialite\Traits\HasSenhaunica;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, HasSenhaunica;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getNomeAttribute($value){
        return Pessoa::nomeCompleto($this->codpes);
    }

    public function getCursoAttribute($value){
        $curso = Graduacao::curso($this->codpes, 8);
        return $curso['nomcur'];
    }

    public function pedidos()
    {
        return $this->hasMany(App\Models\Pedido::class);
    }
}
