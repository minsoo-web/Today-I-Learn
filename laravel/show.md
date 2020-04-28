# laravel

## task detail

1. Router 작성 -> web.php
2. Router에서 정의한 Controller 함수 -> Controller.php
3. View 작성

### Router 연결 -> web.php

laravel이 추천하는 restful 하는 추천 방식  
url : `/tasks/{task}`  
controller 함수 이름 : `show`

```php
Route::get('/tasks/{task}','TaskController@show');
```

### show 함수 작성 -> TaskController.php

```php
//  Task 모델의 아이디를 전달 받는다는 의미인 듯 했다.
public function show(Task $task){
    return view('tasks.show',[
        'task' => $task
    ]);
}
```

### list에서 날라갈 링크 전달 -> index.blade.php

```php
@foreach($tasks as $task)
<a href='/tasks/{{$task->id}}'>
// task의 id 를 전달
</a>
@endforeach
```

### view 파일 작성 -> show.blade.php

Controller 에서 전달한 \$task를 View 에서 보여준다.
