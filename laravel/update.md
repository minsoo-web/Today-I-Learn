# laravel db 수정

1. edit 버튼 생성
2. GET 방식으로 요청했을때의 Route를 만들어준다.
3. 해당 아이디의 수정 페이지를 로드 (아이디에 해당하는 데이터를 다시 뽑아온다)
4. PUT method 를 사용한 form 을 만들어주고
5. PUT 방식으로 요청했을 때의 Route 를 다시 만들어준다 -> web.php
6. 액션 함수를 정의해주고 redirect 위치를 지정해준다.

## edit 버튼 생성

tailwind css 클래스명에 대해 공부할 필요성을 조금 느꼈다.  
기본적인 색상이나 패딩 넓이 이런 것들 외에도 많은 클래스명이 있었는데  
오늘은 flex 클래스에 대해서 배웠다.

> tailwind => **flex**  
> css => display : flex
>
> **flex-1**  
> flex : 1

## GET 방식으로 요청했을 때의 Route 작성

RESTful url

method : GET  
url : /tasks/{task}/edit  
action : edit

```php
// edit
Route::get('/tasks/{task}/edit', 'TaskController@edit');
```

## TaskController.php

```php

public function edit(Task $task){
    return view('tasks.edit',[
        'task'=>$task
    ]);
}

```

> => 는 대입 연산자 같고  
> -> 는 . 연산자 같다.

## edit.blade.php

```php
<form action="/tasks/{{$task->id}}" method="POST">
@method('PUT')
@csrf

// 각각의 input의 value 속성에 {{$task->}} 맞는  값들을 미리 넣어준다.
</form>
```

> html에서 method는 POST 와 GET 밖에 사용 못하므로  
> @method() 를 사용해주어야 한다.  
> form 이므로 @csrf 는 똑같이 작성

## web.php PUT 요청 받기

RESTful url

method : put/push  
url : /tasks/{task}  
action : update

```php
Route::put('/tasks/{task}','TaskController@update');
```

## TaskController update 액션 함수 정의

기존에 post 형식의 요청에는 Reaqust $request 이런식으로 인자를 받아  
$requset->input('name') 이렇게 사용했다면  
laravel 에서 제공하는 편리한 메소드를 사용해보자

```php
public function update(Task $task){
    $task->update([
        'title' => request('title'),
        'body'=>request('body')
    ]);
    // updated_at은 자동으로 바뀌니 해줄 필요 없다.
    return redirect('/tasks/'.$task->id);
}
```

## show.blade.php update 여부에 따라 랜더링 설정

```php
@if($task->created_at != $task->updated_at)
<small class="float-right">{{$task->updated_at}}에 수정됨</small>
@endif
```
