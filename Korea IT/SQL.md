# DATABASE : 

저장소, 데이터를 통합하여 관리하는 집합체를 의미합니다. 

## DATABASE 를 사용하는 이유 
1. 중복된 데이터를 없애고, 자료를 구조화시키고, 효율적인 처리를 할 수 있도록 관리해줌 
2. 다양한 프로그램을 사용하는 사용자들과의 데이터를 공유할 수 있습니다.


## SQL (Structured Query Language)

데이터베이스에서 데이터를 정의, 조작, 제어하기 위해 사용하는 언어입니다.
- 대소문자를 구별하지 않습니다.
- 따옴표는 문자열을 저장할때 '' (싱글따옴표)만 사용합니다. 
  
---

### 데이터베이스 생성 

`CREATE DATABASE phpstudy;`

### 데이터베이스 확인 

`show databases;`

### 데이터베이스 삭제 

`drop database <데이터베이스 이름>`

### 데이터베이스 선택 

`use <데이터베이스 이름>`

### 테이블 생성 

```sql
CREATE table <테이블명>(
    필드명1 필드타입1 제약조건,
    필드명2 필드타입2 제약조건,
    필드명3 필드타입3 제약조건,
    ...
)
```

### 테이블 구조 확인 

`desc 테이블명;`


### 필드 추가 

alter table 테이블명 add 필드이름 필드타입 제약조건;  
`ALTER TABLE tb_member ADD mem_hobby VARCHAR(100);`

> 데이터가 이미 존재하는 테이블에 필드 추가시  
> not null 제약조건은 사용할 수 없다. 

### 필드 수정 

alter table 테이블명 modify column 필드명 필드타입 제약조건;  
`alter table tb_member modify column mem_point int default 1000;`

### 필드 삭제 

alter table 테이블이름 drop 필드이름;  
`alter table tb_member drop mem_hp;`

### 데이터 삽입 (INSERT)

1. insert into 테이블명 values ('값1','값2',...);
   > 선택한 필드에 선택한 값만 넣을 수 없음  
   > 모든 필드에 순서에 맞게끔 입력을 해주어야 함
2. insert into 테이블명 (필드명1,필드명2,....) values ('값1','값2',...);
3. 

---

## 테이블이란? 

데이터를 행과 열로 스키마에 따라 저장할 수 있는 구조

> 스키마 :  
> 데이터 베이스의 구조와 제약 조건에 관한 명세를 기술한 집합을 의미합니다. 

열 -> field , column , attribute  
행 -> row, record, tuple

## 데이터 타입 

1. 숫자 타입 
   - 정수 : (tinyint, smallint, mediumint,) int, bigint 
   - 소수 : float, double 
2. 문자열 타입
   - 텍스트 : char, vachar, text 
   - 바이너리 : binary, varbinary 
   - 
3. 날짜와 시간 타입 
   - 날짜 : date 
   - 날짜와 시간 : datetime, timestamp 

## 데이터의 제약 조건 

데이터의 무결성을 지키기 위해 데이터를 입력받을 때 실행하는 검사 규칙입니다. 

1. NOT NULL 
    - 해당 필드에 NULL 값을 저장할 수 없게 합니다. (필수 데이터)

2. UNIQUE 
    - 해당 필드는 서로 다른 값을 가져야 합니다. (중복 데이터 x)
    - 단, NULL 값은 저장 가능 

3. DEAFAULT 
    - 해당 필드의 기본값을 설정할 수 있게 해줍니다. 

4. AUTO_INCREAMENT 
    - 해당 필드는 자동으로 숫자가 증가되어 추가됩니다. 
    - 따라서 직접 데이터를 추가할 수 없습니다.
  
5. PRIMARY KEY
    - 해당 필드는 오직 하나의 필드에만 설정할 수 있습니다. 
    - 해당 필드는 NOT NULL과 UNIQUE의 특징을 모두 갖습니다. 
    - 데이터를 쉽고 빠르게 찾도록 도와주는 역할을 합니다. (index 기능)
    - 외래키가 (FOREIGN KEY) 참조할 수 있도록 만들어줍니다. 

6. FOREIGN KEY (참조키 외래키)
   -  다른 테이블과 연결해주는 역할을 합니다.  
      기준이 되는 테이블의 내용을 참조해서 레코드가 입력됩니다. 
   -  다른 테이블에 의존하는 필드가 됩니다.
   -  기본키를 참조합니다. 

