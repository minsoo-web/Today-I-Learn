# v-for

## key

업데이트: 2021/06/10

가끔 props나 vuex에 id: Number 로 설정해놓고 그걸 v-for에 key 로 설정했었던 경험이 있다.
이때 비동기 통신을 통해 업데이트 되는 데이터의 default로 v-for를 돌리게 될 경우 Number객체가 v-for의 key로 들어가게 되는 경우가 생기는데
이런 경우 vue-cli가 warning 을 띄우게 된다.

> key는 string이나 number만 가능하다

따라서 이런 경우 Number객체를 사용하지 않고 특정 값으로 대체하는 것으로 해결이 가능하다.
