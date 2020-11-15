# Unittest using Jenkins Pipeline

이번에는 Jenkins의 Pipeline을 이용해서  
이미지를 만들고 컨테이너를 생성해서 API를 배포하고  
유닛테스트를 돌리는 것까지 해보겠습니다.

## 필요한 것

```txt
    개인 노트북
    강한 정신력
    GCP_SETUP, Docker_SETUP, Jenkins_SETUP 까지 마친 강한 의지
```

## pipeline 생성

<img width="1239" alt="스크린샷 2020-11-15 오후 5 38 48" src="https://user-images.githubusercontent.com/57122180/99180410-6dac7480-2769-11eb-8537-a21efc87c5ed.png">

> 💡 컴퓨터 과학에서 파이프라인은 한 데이터 처리 단계의 출력이 다음 단계의 입력으로 이어지는 형태로 연결된 구조를 가리킨다.  
> 이렇게 연결된 데이터 처리 단계는 한 여러 단계가 서로 동시에, 또는 병렬적으로 수행될 수 있어 효율성의 향상을 꾀할 수 있다.  
> 출처: 위키 백과

Jenkins에서 pipeline을 만들어 봅시다.

우선 홈화면에서 `New Items` 를 클릭하면

<img width="339" alt="스크린샷 2020-11-15 오후 4 47 00" src="https://user-images.githubusercontent.com/57122180/99179551-43a38400-2762-11eb-877b-c81b3d71fe8c.png">

이런 화면이 나올텐데 여기서  
프로젝트 이름을 적어주시고

<img width="1262" alt="스크린샷 2020-11-15 오후 4 48 17" src="https://user-images.githubusercontent.com/57122180/99179567-69308d80-2762-11eb-9823-d3dcc9d3d4a5.png">

`Pipeline` 을 골라주고 OK 버튼을 눌러주면  
프로젝트 세팅을 할 수 있는 화면이 나옵니다.

<img width="1262" alt="스크린샷 2020-11-15 오후 4 50 47" src="https://user-images.githubusercontent.com/57122180/99179615-b7de2780-2762-11eb-8829-8a03f28aab7c.png">

깃헙 프로젝트 주소를 적어주고(소스코드가 있는 repo)  
저같은 경우는 10개 한정으로 빌드 기록을 유지하게 했습니다.  
너무 많아지면 저장공간만 차지하고 보기도 불편합니다.

<img width="1262" alt="스크린샷 2020-11-15 오후 4 55 12" src="https://user-images.githubusercontent.com/57122180/99179686-55d1f200-2763-11eb-9fde-cafa8a3bbddc.png">

다른 건 더 건들 필요 없지만 pipeline이 있는 곳에 가보시면  
default가 `Pipeline script`라고 되어 있으실겁니다.  
이걸 `Pipeline script from SCM` 으로 변경해주시고  
SCM을 Git으로 해주면 다음과 같은 화면이 나올겁니다.

<img width="1262" alt="스크린샷 2020-11-15 오후 4 57 35" src="https://user-images.githubusercontent.com/57122180/99179723-aba69a00-2763-11eb-8b59-158e3d22f29f.png">

다음과 같은 순서로 클릭클릭 해주시면 됩니다.

Credentials ADD -> Jenkins

모달창이 하나 뜰겁니다.

<img width="631" alt="스크린샷 2020-11-15 오후 4 59 23" src="https://user-images.githubusercontent.com/57122180/99179759-ec061800-2763-11eb-8a63-171d300fd078.png">

username은 github의 username을 적어주시면 되고,  
password도 github의 password을 적어주시면 되고  
ID는 다른 Credentials와 구별할 수 있게 적어주시면 됩니다(예: minsoo-cred)  
Description은 옵션입니다.

<img width="631" alt="스크린샷 2020-11-15 오후 5 01 30" src="https://user-images.githubusercontent.com/57122180/99179795-38e9ee80-2764-11eb-92db-42e6b0873518.png">

이제 생성된 Credential을 선택해주시고  
Repository URL을 적어주시면 됩니다.(소스코드가 있는 repo)

밑에 보시면 branch 설정이 있는데 default가 master 브랜치입니다.  
`*/deploy` 라고 변경하시면 deploy 브랜치를 clone 받아 오게 됩니다.

저장을 하고 나오면 pipeline 프로젝트가 잘 생성이 된 것을 보실 수 있으실겁니다.

## Jenkinsfile 작성

Jenkinsfile 이라 함은  
Dockerfile처럼 해당 빌드가 돌때 순차적으로 진행되야할 script들을 미리 작성해 놓는, Jenkins script 라고 생각하시면 됩니다.

저희가 해야 할 일은 크게 세가지입니다.

1. 이미지 생성
2. 컨테이너 띄우기
3. unittest 진행

저희가 만든 Dockerfile에는 컨테이너를 띄우기만 해도 알아서 nest App을 동작시키게 끔 해 두었기 때문에  
nest App을 실행시키는 단계는 따로 필요하지 않습니다.

더 좋은 방법이 허다하게 많고 제가 작성한 pipeline이 허점도 많지만  
지금은 컨테이너를 띄우고 uniitest를 실행시키는 일련의 과정을 Jenkins를 통해 자동화 해보는 것을 목표로 한다는 점에서  
'이거 왜 이렇게 하지...?' 라고 의문이 드셔도 양해 부탁드립니다... (많이 부족합니다 🙇‍♂️)

```Jenkinsfile
pipeline {
    agent any

    options {
        // color print를 위한 확장팩으로 plugin을 설치하셔야 에러 없이 동작합니다.
        // ansiColor('xterm')
    }

    stages {
        stage('BUILD IMAGE'){
            steps{
                sh '''
                # nest 라는 이름의 컨테이너가 존재하면 지우는 로직
                if test ! -z "$(docker ps -af name=nest | grep -w nest$)"; then
                    docker stop nest && docker rm nest
                fi

                # dockerfile을 통해 이미지를 빌드
                docker build -t nest-app .
                # <none>이라는 이름의 이미지들을 지우는 명령어
                docker rmi $(docker images --filter "dangling=true" -q --no-trunc)
                '''
            }
        }
        stage('RUN CONTAINER'){
            steps{
                sh'''
                # 컨테이너를 띄워 API를 활성화 합니다
                docker run -itd --name nest -p 3000:3000 nest-app:latest
                '''
            }
        }
        stage('RUN UNITTEST'){
            steps{
                sh '''
                # jest를 활용한 테스트를 진행합니다.
                docker exec -t nest npm run test
                '''
            }
        }
    }
}
```

## User -> jenkins

지난 GCP_SETUP 단계에서  
docker 명령어를 사용하기 위해서 `sudo`를 붙여야만 사용이 가능했던 점 기억 나시나요?

Jenkins pipeline을 사용하게 되면  
유저가 jenkins로 변경되어 접속하게 됩니다.

따라서 jenkins에게도 docker 명령어에 대한 권한을 부여해줘야 에러가 나질 않습니다.

```bash
sudo usermod -aG docker jenkins
sudo service docker restart
sudo service jenkins restart # 안 해줬더니 에러가 나길레 restart 해보니 해결됐습니다.
```

## 로그

별 탈 없이 진행이 잘 되었다면 다음과 같은 화면이 나올 겁니다.

<img width="1260" alt="스크린샷 2020-11-15 오후 5 20 38" src="https://user-images.githubusercontent.com/57122180/99180117-e3631100-2766-11eb-946b-d3bd404a4488.png">

무시하고 넘어갈 수도 있지만 이게 가시적으로 꽤나 보기 힘듭니다.  
해결 방법은 꽤나 간단합니다.

package.json

```json
{
	// skip
	"scripts": {
		// "test": "jest"
		"test": "jest >> temp.txt"
	}
	// skip
}
```

테스트가 진행되는 동안 로그를 계속 찍는 문제이기 때문에  
테스트가 끝날 때까지 모든 로그를 temp.txt 에 담아두고  
결과만 Jenkins 로그에 찍어주면 됩니다.

## 결과

<img width="370" alt="스크린샷 2020-11-15 오후 5 25 56" src="https://user-images.githubusercontent.com/57122180/99180202-a0ee0400-2767-11eb-82ca-466a6733e48c.png">

다음에는  
PR을 통해 빌드를 자동화하는 것  
jest를 통해 생성한 junit 형태의 xml 파일들을 Jenkins에 올리는 것  
unittest + E2E 테스트를 효율적으로 진행할 수 있는 multibranch pipeline  
최종적으로는 k8s를 도입해서 패치를 해도 API 배포에 끊임이 없도록 진행하는 것이 목표입니다.

🙇‍♂️ 부족한 글 끝까지 읽어주셔서 감사합니다.  
진행하시면서 막히셨던 부분들은 얼마든지 연락주시면 제가 아는 선에서 최대한 도와드리겠습니다.

[오픈 카톡 링크](https://open.kakao.com/me/minsooweb)
