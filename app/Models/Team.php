<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Attendance\App\Models\Attendance;

class Team extends Model
{
    protected $guarded = [];

    protected $appends = ['name', 'description', 'designation','team_count'];

    public function attendance()
    {
        return $this->hasOne(Attendance::class, 'team_id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'team_id');
    }

    public function getTeamCountAttribute()
    {
        return self::count();
    }

    public function translate(){
        return $this->belongsTo(TeamTranslation::class, 'id',
            'team_id')
            ->where('lang_code' , admin_lang())
            ->withDefault([
                'name' => '',
                'description' => '',
                'designation' => '',
            ]);
    }

    public function front_translate(){
        return $this->belongsTo(TeamTranslation::class, 'id', 'team_id')->where('lang_code' , front_lang());
    }
    public function getNameAttribute(){
        return $this->translate->name;
    }
    public function getDescriptionAttribute(){
        return $this->translate->description;
    }
    public function getDesignationAttribute(){
        return $this->translate->designation;
    }
}
