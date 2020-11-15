# GCP 셋업하기

GCP 에서 인스턴스를 생성하고 필요한 패키지들을 세팅해봅시다!

## 필요한 것

    개인 노트북
    강한 정신력
    Google 계정

### Google Compute Engine

#### 1. 인스턴스 생성하기

참조 사이트
<https://nirsa.tistory.com/82>

<img width="1278" alt="스크린샷 2020-11-14 오후 2 56 07" src="https://user-images.githubusercontent.com/57122180/99140960-880f2100-2689-11eb-8f67-9df190df9ae8.png">

<https://console.cloud.google.com/> 로 들어가면 다음과 같은 화면이 나올 겁니다.

> **이미 만들어 놓은 게 있다면 다음 단계로 넘어가시면 됩니다!**

`무료로 사용해 보기` 를 누르면

<img width="1278" alt="스크린샷 2020-11-14 오후 3 01 17" src="https://user-images.githubusercontent.com/57122180/99141047-40d56000-268a-11eb-8066-ed3df45fd7be.png">

동의를 해주고

<img width="1278" alt="스크린샷 2020-11-14 오후 3 03 31" src="https://user-images.githubusercontent.com/57122180/99141080-91e55400-268a-11eb-86a9-4da878701cd0.png">

계정 유형을 개인으로 설정 -> 이름 및 주소를 채워줍시당  
결제 정보까지 다 채워주시면 대시보드 상단에서 `무료 평가판 상태` 가 활성화 된 것을 확인해볼 수 있으실겁니다!

<img width="497" alt="스크린샷 2020-11-14 오후 5 49 13" src="https://user-images.githubusercontent.com/57122180/99143555-b862b980-26a1-11eb-96cd-b4fd1124949d.png">

화면 좌측 햄버거 메뉴를 눌러 스크롤을 해보면 `Compute Engine` 메뉴가 있고 거기에 가상 머신 중 `VM 인스턴스`를 눌러 만들기를 눌러주세요

    리전: asia-northeast3(서울)
    영역: asia-northeast3-a

머신구성 (목적에 맞게 구성을 바꾸셔도 됩니다.)

    시리즈: E2
    머신 유형: e2-medium (이거 써봤는데 진짜 너무 느립니다 🤦)
    (수정) e2-standard-2(vCPU 2개, 8GB 메모리) <- 이거 쓰세요,,,

    부팅 디스크
    Ubuntu 16.04 LTS -> 50GB

    엑세스 범위 -> 모든 Cloud API에 대한 전체 액세스 허용
    방화벽 -> HTTP/HTTPS 허용

생성!!

#### 2. 인스턴스 접속

참조 사이트  
<https://jybaek.gitbook.io/with-gcp/appendix/gce_to_ssh>

가상 컴퓨터에 접속을 하기 위해서는 ssh 접속을 해야합니다.  
하지만 누구나 제 노트북에 접속할 수 없듯, 제 GCE 에도 접속할 수 없습니다.  
그치만, 저는 접근이 가능해야하므로 제 GCE에 rsa 키를 등록해야합니다.

##### rsa 키 생성

```bash
ssh-keygen -t rsa -f ~/.ssh/[KEY_FILE_NAME] -C [USERNAME]

ssh-keygen -t rsa -f ~/.ssh/gcp_rsa -C "minsoo.web@gmail.com"
```

##### 생성된 퍼블릭 키 복사

```bash
cat ~/.ssh/gcp_rsa.pub
```

cat으로 읽은 데이터 모두를 복사합니다.

GCP -> Compute Engine -> (설정) 메타데이터 -> SSH 키

수정 (또는 추가)

항목 추가를 누르면 키네임이 알아서 들어가게 되고 복사한 키 데이터를 입력하면 됩니다.

<img width="1097" alt="스크린샷 2020-11-14 오후 8 06 17" src="https://user-images.githubusercontent.com/57122180/99145811-12b94580-26b5-11eb-8662-b43614b5d7f5.png">

저장하고 나오기

터미널에 다음과 같은 명령어를 입력합니다.

##### 접속

```bash
ssh -i ~/.ssh/[rsa_KEY_NAME] [구글아이디]@[인스턴스 외부 ip]

ssh -i ~/.ssh/gcp_rsa minsoo.web@[ip는 비밀]
```

> 외부 ip 는 VM 인스턴스 대시보드에서 확인 가능합니다.

이렇게 치고 나면
`yes/no/[fingerprint]?` 이렇게 물어보는데 yes 라고 쳐주시면 됩니다.

**Tada!**

<img width="695" alt="스크린샷 2020-11-14 오후 8 13 57" src="https://user-images.githubusercontent.com/57122180/99145898-0d102f80-26b6-11eb-90c9-d84dd0a736ea.png">

##### ~/.ssh/config 파일 설정

```bash
# code 명령어 활성화 되었다면
code ~/.ssh/config

# 안 되었다면 vi 편집기로
vi ~/.ssh/config
```

다음과 같이 작성해주고 저장해줍니다.

```config
Host gcp
    HostName [your_ip]
    IdentityFile /Users/gimminsu/.ssh/gcp_rsa
    User minsoo.web
```

이제 훨씬 간단하게 접속이 가능합니다.

```bash
ssh gcp
```

### Package Setup

`git` 은 기본적으로 설치되어 있습니다.

Ubuntu의 패키지 매니저인 `apt-get`을 사용하여 필요한 패키지들을 설치해 보겠습니다.

#### node, npm 설치

```bash
# apt-get update
sudo apt-get update
# vim 설치
sudo apt-get install -y vim

# 12 버전 Node 셋업 파일 설치
# 버전 명시를 안 해주면 node 8 버전이 설치됨
curl -sL https://deb.nodesource.com/setup_12.x | sudo -E bash -

# nodejs 설치
sudo apt-get install -y nodejs
```

#### docker 설치

참고 자료
<https://docs.docker.com/engine/install/ubuntu/>

```bash
sudo apt-get update
sudo apt-get install \
    apt-transport-https \
    ca-certificates \
    curl \
    gnupg-agent \
    software-properties-common
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -
sudo add-apt-repository \
   "deb [arch=amd64] https://download.docker.com/linux/ubuntu \
   $(lsb_release -cs) \
   stable"
sudo apt-get update
sudo apt-get install docker-ce docker-ce-cli containerd.io
```

다만 이렇게 설치할 경우 root 유저가 아닌 gcp 유저로 로그인하게 되기 때문에
docker의 유저 모드를 변환해주어야 합니다.

**에러 로그**

<img width="1259" alt="스크린샷 2020-11-14 오후 9 02 39" src="https://user-images.githubusercontent.com/57122180/99146569-bce89b80-26bc-11eb-9459-5f86d1bbd2b9.png">

```bash
sudo usermod -aG docker $USER
sudo service docker restart
```

후에 터미널을 닫고 (컨트롤 d or cmd d)
다시 ssh 접속을 하게되면 더이상 sudo를 붙이지 않고 docker 명령어를 사용할 수 있게 됩니다!!!

#### Jenkins

참고 자료
<https://velog.io/@hamon/Ubuntu18.04%EC%97%90-Jenkins-%EC%84%A4%EC%B9%98%ED%95%98%EA%B8%B0>
<https://www.jenkins.io/doc/book/installing/linux/>

jenkins를 설치하기 위해서는 jdk가 필요합니다.

```bash
sudo apt-get update
sudo apt-get install -y openjdk-8-jdk
```

그리고 나서 터미널에 다음과 같은 명령어를 순차적으로 작성해주세요

```bash
wget -q -O - https://pkg.jenkins.io/debian-stable/jenkins.io.key | sudo apt-key add -
sudo sh -c 'echo deb https://pkg.jenkins.io/debian-stable binary/ > \
    /etc/apt/sources.list.d/jenkins.list'
sudo apt-get update
sudo apt-get install -y jenkins
```

java를 꼭 먼저 설치해주셔야 합니다.

그리고 저는 vue로 개발을 하기 때문에 8080 포트를 쓰는 것이 뭔가 조금 꺼림칙 해서 default port를 변경해주었습니다.

```bash
sudo vi /etc/default/jenkins
```

열린 파일에서  
`HTTP_PORT=8080`  
을 사용하지 않는 포트 번호로 변경해주시면 됩니다.

##### 방화벽 풀어주기

참고자료
<https://kibua20.tistory.com/96>

지금 현재 저희의 GCE 에는 방화벽이 활성화 되어있기 때문에 8082 포트가 막혀있는 상태입니다.

다음 메뉴 경로로 들어가서 방화벽 설정을 해줍시다.

GCP console -> VPC 네트워크 -> 방화벽 -> 방화벽 규칙 만들기

<img width="487" alt="스크린샷 2020-11-14 오후 9 43 14" src="https://user-images.githubusercontent.com/57122180/99147201-68e0b580-26c2-11eb-9a18-d4b2a8e74890.png">

다른건 기본 설정으로 놔두시고

대상 태그: http-server
소스 IP 범위: 0.0.0.0/0
지정된 프로토콜 및 포트: tcp -> 8082

이렇게 설정해주시면 됩니다.  
Jenkins는 어차피 회원제로 로그인을 하는 구조이기 때문에  
소스 IP를 `0.0.0.0/0`으로 모두 허용해 주었습니다.

집에서만 사용하신다면 집 네트워크 ip로 설정해두어도 됩니다.

##### Jenkins 설정

이제 웹 페이지로 접근을 해봅시다!

브라우저를 열고
http://[gcpip]:8082 로 열게되면 다음과 같은 화면이 나올 겁니다.

<img width="630" alt="스크린샷 2020-11-14 오후 9 47 17" src="https://user-images.githubusercontent.com/57122180/99147274-f91efa80-26c2-11eb-8a4a-e1d0baafac9f.png">

> 💡 혹시나 이 페이지가 안 뜬다면  
> `netstat -tnlp`  
> 를 입력하셔서 8082 포트가 제대로 열려있는지 확인을 해보시고  
> 방화벽 설정이 제대로 되었는지 확인을 해보시고  
> `sudo service jenkins restart`  
> 재시작을 해보시길 바랍니다.

관리자 비밀번호를 쳐야 다음단계로 갈 수 있는데 이는 화면 중간에 나와있는 경로로 확인해 볼 수 있습니다.

```bash
sudo cat /var/lib/jenkins/secrets/initialAdminPassword
```

나온 비밀번호를 copy -> web에 paste를 하게 되면 다음 단계로 넘어갈 수 있게 됩니다.
