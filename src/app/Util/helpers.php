<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\GroupUser;
use App\Models\item;
use Illuminate\Support\Facades\DB;

class helpers
{
    public static $page = 7; // ペジネーションの数

    // select条件
    public static $select = ["item_id", "group_name", "item_type", "title", "date", "uid", "user_name", "status", "open_range", "is_open"];

    /**
     * ログイン中のユーザーとリクエストされたユーザーidをチェック
     */
    public static function checkUserId($val): bool
    {
        if ($val != Auth::id()) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * マスタ管理者のチェック
     */
    public static function checkMasterAdmin(): bool
    {
        if (Auth::user()->is_admin != 1) {
            return false;
        } else {
            return true;
        }
    }

    /**
     *グループー管理者のチェック
     */
    public static function checkGroupAdmin(): bool
    {
        if (Auth::user()->is_admin != 2) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * 管理者のチェック
     */
    public static function checkAdmin(): bool
    {
        if (!self::checkMasterAdmin() && !self::checkGroupAdmin()) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * グループ管理者の取得
     */
    public static function getGroupAdminUser(): object
    {
        return GroupUser::where('user_id', Auth::id())->where('group_admin', 1)->get();
    }

    /**
     * グループ管理者かつマスタ管理者でないかをチェック
     */
    public static function checkAdminNum($val): bool
    {
        // グループ管理者の数を取得
        $g_admin = GroupUser::where('user_id', $val)->where('group_admin', 1)->pluck('group_admin');
        $count = $g_admin->count();
        $admin = User::find($val);

        // グループ管理者が1つのみでマスター管理者でもない場合
        if ($count < 2 && $admin->is_admin != 1) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * グループに参加しているかをチェック
     *
     * @return boolean
     */
    public static function checkInGroup($group_id): bool
    {
        $group = User::find(Auth::id())->group()->get()->toArray();
        $res = false;

        foreach ($group as $g) {
            if (empty($g['id'] == $group_id)) {
                $res = false;
            } else {
                $res = true;
                break;
            }
        }
        return $res;
    }

    /**
     * ダイビング関連のグループかどうかを判定
     */
    public static function checkDivingGroup($group_type)
    {
        if ($group_type == 0) {
            $serch = DB::raw(Item::UnionNoDivelog());
        } else if ($group_type == 1) {
            $serch = DB::raw(Item::UnionAll());
        }
        return $serch;
    }
}
