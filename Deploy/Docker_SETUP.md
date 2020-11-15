# Docker Setup

Jenkins를 사용하지 않고, 수작업으로
nest app을 백그라운드로 돌릴 수 있는 이미지를 만들어 postman 테스트까지 해봅시다!

## 필요한거

```txt
    개인 노트북
    강한 정신력
    GCP_SETUP 단계를 마친 강한 당신
```

## Clone Project

github에 프로젝트가 올라가있다는 가정하에 시작하겠습니다.

```bash
git clone http://your_project_url.git
cd your_project
```

## Create Dockerfile

Dockerfile은 다음과 같이 작성했습니다.

```Dockerfile
# Step 1
FROM node:10 AS builder
WORKDIR /app

COPY . .

RUN npm install
RUN npm run build

# step 2
FROM node:10-alpine
WORKDIR /app
EXPOSE 3000

## Stop1의 build에서 만든 프로젝트를 가져온다.
COPY --from=builder /app ./
CMD ["npm", "run", "start:prod"]
```

### dockerignore

```dockerignore
node_modules
dist
```

결과 파일들과 node_modules는 복사가 되면 안 되기 때문에  
`.dockerignore`라는 파일을 생성해서 dockerfile과 같은 경로에 놔주시면 됩니다.

## Build & Run

```bash
docker build -t your_image_name .
docker run -itd --name your_container_name -p 3000:3000 your_image_name:latest
```

dockerfile을 통해 이미지를 빌드하고,  
이미지를 통해 컨테이너를 백그라운드로 돌리고(d옵션)  
`3000` 포트를 열어주는 작업을 했습니다.

docker ps  
<img width="1277" alt="스크린샷 2020-11-15 오후 2 31 44" src="https://user-images.githubusercontent.com/57122180/99177686-65474000-274f-11eb-8500-0741da833c62.png">

docker images  
<img width="629" alt="스크린샷 2020-11-15 오후 2 33 18" src="https://user-images.githubusercontent.com/57122180/99177704-8314a500-274f-11eb-89ac-c6b13cf788ac.png">

`netstat` 명령어를 통해 포트 바인딩이 제대로 되었는지 확인해 봅시다.

<img width="704" alt="스크린샷 2020-11-15 오후 2 35 12" src="https://user-images.githubusercontent.com/57122180/99177735-c707aa00-274f-11eb-84c3-ba56cd81ef6e.png">

## 방화벽 해제

`GCP_SETUP`에서 해주었던 과 똑같은 방법으로 3000번 포트를 열어줍니다.  
단, 여기서 주의해야할 점은 API 서버는 모든 수신을 열어주면 안 됩니다.  
해킹의 여지가 있으며 DB열람을 통해 중요한 데이터가 유출될 가능성 또한 있기 때문에  
개발환경에 맞는 ip 주소들만 열어주는 게 맞습니다.

저는 우선 저희 집 ip만 열어주었습니다.  
<img width="704" alt="스크린샷 2020-11-15 오후 2 58 02" src="https://user-images.githubusercontent.com/57122180/99178067-f7047c80-2752-11eb-8986-0ac9441c0608.png">

## Postman 테스트

API 테스트를 하는 방법은 여러가지가 있지만 (Insomnia, vscode extension 등등) 저는 postman을 선호하기에 postman으로 테스트를 진행해보겠습니다.

Get all movies  
<img width="590" alt="스크린샷 2020-11-15 오후 3 04 24" src="https://user-images.githubusercontent.com/57122180/99178208-15b74300-2754-11eb-981b-87a201225d19.png">

Get one movie  
<img width="590" alt="스크린샷 2020-11-15 오후 3 04 57" src="https://user-images.githubusercontent.com/57122180/99178209-18b23380-2754-11eb-80db-fa809b42bf90.png">

Post one movie  
<img width="590" alt="스크린샷 2020-11-15 오후 3 05 24" src="https://user-images.githubusercontent.com/57122180/99178211-19e36080-2754-11eb-878d-b96d616d64d9.png">

이제 이 일련의 과정을 Jenkins를 통해 자동화하고  
빌드와 동시에 Jest test를 돌려서 unittest 또한 진행해보도록 하겠습니다.
