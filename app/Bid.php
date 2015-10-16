<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Bid extends Model
{
    protected $table = 'bids';

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function setPlaceIdAttribute($value)
    {
        $this->attributes['lat'] = $value['H'];
        $this->attributes['lng'] = $value['L'];
    }

    public function setDeadlineAttribute($value)
    {
        if (strlen(trim($value)) > 0) {
          $date = \Carbon\Carbon::createFromFormat('d/m/Y', $value);
          $this->attributes['deadline'] = $date;
        }else {
          $this->attributes['deadline'] = null;
        }
    }

    public function getDeadlineAttribute($value)
    {
        if ($value == null) {
          return $value;
        }else {
          return (new \Carbon\Carbon($value))->format('d/m/Y');
        }
    }

    public function scopeSearchRadius($query, $dist, $id, $order = 'amount_difference')
    {
        $ln1 = $this->lng - $dist/abs(cos(deg2rad($this->lat))*111.2);
        $ln2 = $this->lng + $dist/abs(cos(deg2rad($this->lat))*111.2);
        $lt1 = $this->lat - ($dist/111.2);
        $lt2 = $this->lat + ($dist/111.2);
        return $query->join('users', 'users.id', '=', 'bids.user_id')
          ->select("bids.id", "bids.address", "bids.deadline", "bids.currency", "bids.operation", "bids.lng", "bids.lat", "bids.amount", "bids.price", "users.nome", "users.sobrenome", "users.profile_pic",
            DB::raw("6371 * 2 * ASIN(SQRT(POWER(SIN(($this->lat - bids.lat) * pi()/180 / 2), 2) +
            COS($this->lat * pi()/180) * COS(bids.lat * pi()/180) * POWER(SIN(($this->lng - bids.lng) * pi()/180 / 2), 2)))
            as distance,
            ABS($this->amount - bids.amount) as amount_difference")
            )->whereBetween('bids.lng', [$ln1, $ln2])
              ->whereBetween('bids.lat', [$lt1, $lt2])
              ->whereNotIn('bids.user_id', [$id])
              ->where(function ($query) {
                $query->where('deadline', '>', \Carbon\Carbon::now())
                      ->orWhere('deadline', null);
                })
              ->where('bids.operation', '!=', $this->operation)
              ->where('bids.currency', '=', $this->currency)
              ->orderBy($order, 'asc')
              ->having('distance', '<', $dist);
    }

    public function scopeSearchFriendsRadius($query, $dist, $user, $order = 'amount_difference')
    {
        $ln1 = $this->lng - $dist/abs(cos(deg2rad($this->lat))*111.2);
        $ln2 = $this->lng + $dist/abs(cos(deg2rad($this->lat))*111.2);
        $lt1 = $this->lat - ($dist/111.2);
        $lt2 = $this->lat + ($dist/111.2);
        return $query->join('users', 'users.id', '=', 'bids.user_id')
          ->select("bids.id", "bids.address", "bids.currency", "bids.deadline", "bids.operation", "bids.lng", "bids.lat", "bids.amount", "bids.price", "users.nome", "users.sobrenome", "users.profile_pic",
            DB::raw("6371 * 2 * ASIN(SQRT(POWER(SIN(($this->lat - bids.lat) * pi()/180 / 2), 2) +
            COS($this->lat * pi()/180) * COS(bids.lat * pi()/180) * POWER(SIN(($this->lng - bids.lng) * pi()/180 / 2), 2)))
            as distance,
            ABS($this->amount - bids.amount) as amount_difference")
            )->whereBetween('bids.lng', [$ln1, $ln2])
              ->whereBetween('bids.lat', [$lt1, $lt2])
              ->whereNotIn('bids.user_id', [$user->id])
              ->whereIn('bids.user_id', $user->friends->modelKeys())
              ->where(function ($query) {
                $query->where('deadline', '>', \Carbon\Carbon::now())
                      ->orWhere('deadline', null);
                })
              ->where('bids.operation', '!=', $this->operation)
              ->where('bids.currency', '=', $this->currency)
              ->orderBy($order, 'asc')
              ->having('distance', '<', $dist);
    }

    public function scopeSearchTeste($query, $lat, $lng, $dist)
    {
        $ln1 = $lng - $dist/abs(cos(deg2rad($lat))*111.12);
        $ln2 = $lng + $dist/abs(cos(deg2rad($lat))*111.12);
        $lt1 = $lat - ($dist/111.12);
        $lt2 = $lat + ($dist/111.12);
        return $query->select("id", "address", "currency", "operation", "lng", "lat", "amount", "price",
          DB::raw("6378.14 * 2 * ASIN(SQRT(POWER(SIN(($lat - lat) * pi()/180 / 2), 2) +
          COS($lat * pi()/180) * COS(lat * pi()/180) * POWER(SIN(($lng - lng) * pi()/180 / 2), 2)))
          as distance")
          )->whereBetween('lng', [$ln1, $ln2])
            ->whereBetween('lat', [$lt1, $lt2])
            ->orderBy('distance', 'asc')
            ->get();
    }
}
