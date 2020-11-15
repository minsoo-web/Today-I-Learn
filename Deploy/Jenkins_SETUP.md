# Jenkins 셋업하기

Jenkins 기본 셋업을 해봅시다!

## 필요한거

    개인 노트북
    강한 정신력
    GCP_SETUP 단계를 마친 강한 당신

## Start Jenkins App

### Install Suggested Plugins

<img width="988" alt="스크린샷 2020-11-14 오후 11 03 36" src="https://user-images.githubusercontent.com/57122180/99148871-a39c1b00-26cd-11eb-96a0-496f664b51fd.png">

만약 GCP_SETUP 단계를 끝마치셨다면 위 화면이실겁니다.

어차피 필요한 플러그인들은 추가로 설치할 예정이니 우선 suggested plugins 을 설치해줍시다. 왼쪽 버튼을 눌러주세요!

설치가 끝나길 기다립시다...!

<img width="988" alt="스크린샷 2020-11-14 오후 11 19 03" src="https://user-images.githubusercontent.com/57122180/99149184-caf3e780-26cf-11eb-8684-4f281f5faa11.png">

### Signup Admin Account

관리자 회원가입 절차는 엄청 간단합니다 (까먹지 않게 잘 기억해두세요...!)  
그리고 젠킨스는 한글 영어 비밀번호를 구분합니다. 이 점도 꼭 염두해서 회원가입 하세요!

<img width="988" alt="스크린샷 2020-11-14 오후 11 58 38" src="https://user-images.githubusercontent.com/57122180/99150060-5328bb80-26d5-11eb-818d-47f2d5f31db5.png">

URL은 바꾸지 마시구 클릭 몇 번 더 하다보면 대시보드 화면에 진입하실 수 있습니다.

<img width="1277" alt="스크린샷 2020-11-15 오전 12 01 21" src="https://user-images.githubusercontent.com/57122180/99150118-b31f6200-26d5-11eb-840f-d612476c3615.png">

## Change Theme

Jenkins 는 무료 오픈 소스라서 그런건지는 잘 모르겠지만 UI가 엄청 이쁜 편은 아닙니다.

다만 theme를 사용하면 조금 더 편안한 화면을 보실 수 있는데 그걸 지금부터 해볼까 합니다.

참고 자료  
<https://jojoldu.tistory.com/343>

사실 이 부분은 제가 손 댈 곳이 없이 저 포스팅만 따라하시면 됩니다... 너무 정리를 잘 해놓으셔서 🥺

저는 cyan 색을 좋아해서 cyan으로 적용해봤습니다.

<img width="1277" alt="스크린샷 2020-11-15 오전 12 20 25" src="https://user-images.githubusercontent.com/57122180/99150499-5d988480-26d8-11eb-93c3-84d70c2a716b.png">

## Blue Ocean

참고자료  
<https://medium.com/@jyson88/jenkins-blue-ocean-%EC%82%AC%EC%9A%A9-%EB%B0%A9%EB%B2%95-579d8059a7b7>

Blue Ocean은 나중에 꼭 필요한 plugin인지라 셋업 부분에 써 넣어 놓았습니다.

## 추후 계획

우선 셋업은 여기까지만 해놓구  
docker 이미지 셋업을 끝마쳐 놓은 뒤에 Jenkins로 다시 돌아오겠습니다!
