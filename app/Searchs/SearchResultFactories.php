<?php
namespace App\Searchs;

use App\Models\Users\User;

class SearchResultFactories{

  // 改修課題：選択科目の検索機能
  public function initializeUsers($keyword, $category, $updown, $gender, $role, $subjects){

    if($category == 'name'){
      if(is_null($subjects)){
        $searchResults = new SelectNames();
        //名前が入ってない場合はこれを実行
      }else{
        $searchResults = new SelectNameDetails();
        //名前が入っていた場合はこれを実行
      }
      return $searchResults->resultUsers($keyword, $category, $updown, $gender, $role, $subjects);
    }else if($category == 'id'){
      if(is_null($subjects)){
        $searchResults = new SelectIds();
        //idが入ってない場合はこれを実行
      }else{
        $searchResults = new SelectIdDetails();
        //idが入っていた場合はこれを実行
      }
      return $searchResults->resultUsers($keyword, $category, $updown, $gender, $role, $subjects);
    }else {
      $allUsers = new AllUsers();
    return $allUsers->resultUsers($keyword, $category, $updown, $gender, $role, $subjects);
    }
  }
}
