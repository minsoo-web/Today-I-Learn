# android 기말 시험 공부

## 4장 기본 위젯 익히기 - 1. 뷰의 개요

### id 속성

id 할당

```xml
<Button
    android:id='@+id/btn1'
/>
```

id에 접근

```java
Button button1;
button1 = (Button) findViewById(R.id.btn1);
```

### layout_width / layout_height 속성

이 속성들은 모든 위젯에 필수로 들어가야 하는 속성이다.  
각각 위젯의 폭, 높이를 나타내며, `match_parent` , `wrap_content`로 지정할 수 있다.

> 숫자를 직접 크기를 지정할 수 있으며 단위는 dp, px, sp 등으로 지정 가능하다.

### orientation 속성

default는 `horizontal` 이며 이는 수평으로 위젯을 배치하는 의미이다.  
`vertical`로 값을 지정해주게 되면 이제 위젯의 크기와 상관없이 수직으로 배치가 된다.

### visible 속성

위젯을 보이게 할 지에 대한 여부를 결정하는 속성으로  
default는 보이는 상태인 `visible`  
`invisible`은 보이지만 않고 공간은 차지  
`gone`은 공간도 차지하지 않는 상태이다.

## 4장 기본 위젯 익히기 - 2. 기본 위젯 다루기

### TextView

속성으로는 다음과 같은 속성들이 있다.

- text : 텍스트 뷰에 나타나는 문자열
- textColor : 글자의 색상을 지정
- textSize : 글자의 크기를 지정
- typeface : 글자의 글꼴
- textStyle : 글자의 스타일 (bold, italic 등등)
- singleLine : 글이 길어 줄이 넘어갈 경우 강제로 한 줄만 표가하고 `...`으로 표기할 수 있다.

### Java 코드로 XML 속성 제어

```java
public void onCreate(Bundle savedInstanceState){
    super.onCreate(savedInstanceState);
    setContentView(R.layout.main);

    TextView tv1, tv2, tv3;
    tv1 = (TextView) findViewById(R.id.textView1);
    tv2 = (TextView) findViewById(R.id.textView2);
    tv3 = (TextView) findViewById(R.id.textView3);

    tv1.setText('텍스트 설정');
    tv1.setTextColor(Color.RED);
    tv2.setTextSize(30);
    tv2.setTypeface(Typeface.SANS_SERIF,Typeface.BOLD_ITALIC);
    tv3.setSingleLine(true);
}
```

### Button & EditText

버튼은 클릭했을 때의 액션을 java 코드에서 정의해주어야 한다.

```java
Button mybutton; // 버튼 변수 선언
mybutton = (Button) findViewById(R.id.btn1); // 변수에 버튼 위젯 대입
mybutton.setOnClickListener( new View.onClickListener(){
    public void onClick(View v){
        // 동작할 액션을 코딩
    }
})

```

## 4장 기본 위젯 익히기 - 3. 기본 위젯 활용하기

### CompoundButton (컴파운드 버튼)

컴파운드 버튼의 하위 클래스로는 체크박스, 토글버튼, 라디오버튼이 있다.

#### CheckBox

XML 코드

```xml
<CheckBox
    android:id="@+id/andorid"
    android:text="안드로이드"
    android:checked="true"
/>
```

체크와 언체크가 바뀌었을 때 java 코드 처리

```java
CheckBox mycheck;
mycheck = (CheckBox) findViewById(R.id.android);
mycheck.setOnCheckedChangeListener(new CompoundButton.OnCheckedChangeListener(){
    public void onCheckedChanged(CompoundButton buttonView, boolean isChecked){
        // 액션 정의
    }
})
```

#### 라디오버튼과 라디오 그룹

XML 코드

```xml
<RadioGroup
    android:id="@+id/rGroup1"
>
    <RadioButton
        android:text="남성"
    />
    <RadioButton
        android:text="여성"
    />
</RadioGroup>
```

#### 이미지 뷰

XML 코드

```xml
<!--  사진은 app/res/drawable/여기에 저장한다. -->
<ImageView
    android:src="@drawable/q10.png"
/>
```

Java 코드에서 소스 제어

```java

ImageView iv1;
iv1 = (ImageView) findViewById(R.id.iv1);
iv1.setImageResource(R.drawable.image1); // res/drawable/image1 이라는 사진이 있어야 한다.
```

## 5장 레이아웃 익히기 - 1. 레이아웃의 개요

### 레이아웃의 종류

이번 수업에서 배운 레이아웃의 종류는

1. LinearLayout  
   레이아웃의 왼쪽 위부터 아래쪽 또는 오른쪽으로 차례로 배치
2. RelativeLayout  
   위젯 자신이 속한 레이아웃의 상하좌우 위치를 지정하여 배치하거나  
   다른 위젯으로부터 상대적인 위치를 지정한다.
3. TableLayout  
   위젯을 행과 열의 개수를 지정한 테이블 형태로 배열한다.
4. GridLayout  
   테이블레이아웃과 비슷하지만 행도는 열을 확장하여 다양하게 배치할 때  
   더 편리하다.
5. FrameLayout  
   위젯을 왼쪽 위에 일률적으로 겹쳐서 배치하여 중복되어 보이는 효과를 낼 수 있다.  
   여러개의 위젯을 배치한 후 상황에 따라서 필요한 위젯을 보이는 방식에 주로 활용된다.

## 5장 레이아웃 익히기 - 2. LinearLayout

### 기본 LinearLayout의 형태

#### gravity와 layout_gravity 속성

`gravity`속성은 레이아웃 안의 위젯을 어디에 배치할 것인지를 결정하며 값으로는

- left
- right
- center
- top
- bottom

등을 사용할 수 있으며 2개를 조합해서 `right|bottom` 처럼 사용할 수 있다.

gravity 속성은 layout에 주고  
layout_gravity는 레이아웃 안의 위젯에 주는 속성으로 레이아웃 안에서  
위젯이 어디에 배치 될지를 정하는 속성이다.

## 5장 레이아웃 익히기 - 3. 기타 레이아웃

### RelativeLayout

렐러티브레이아웃은 상대 레이아웃이라고도 하며, 이름처럼 레이아웃 내부에 포함된 위젯을 상대적인 위치로 배치한다. 렐러티브레이아웃 안에 포함된 위젯은 자신의 위치를 렐러티브레이아웃의 어디쯤에 위치시킬 것인지 지정해야 한다. 렐러티브레이아웃에 있는 위젯의 위치와 관련된 속성은 크게 두 부류로

렐러티브레이아웃의 상하좌우에 배치하는 경우  
다른 위젯의 상대 위치에 배치하는 경우가 있다.

#### 렐러티브레이아웃의 상하좌우에 배치

렐러티브레이아웃 안에 포함된 위젯의 속성 중 부모(레이아웃)의 어느 위치에 배치할지를 결정하는 속성은 모두 일곱 가지이다.

1. layout_alignParentLeft
2. layout_centerHorizontal
3. layout_alignParentRight

4. layout_centerInParent

5. layout_alignParentTop
6. layout_centerVertical
7. layout_alighnParentBottom

값을 할당할때는 true라고 주면 된다.

#### 다른 위젯의 상대 위치에 배치

상하좌우

1. android:layout_above : 상
2. android:layout_below : 하
3. android:layout_toLeftOf : 좌
4. android:layout_toRightOf : 우

기준 위젯에서의 상하좌우

1. android:layout_alignTop : 상
2. android:layout_alignBaseLine : 중
3. android:layout_alignBottom : 하

4. android:layout_alignLeft : 좌
5. android:layout_alignRight : 우

### TableLayout

테이블레이아웃은 주로 위젯을 표 형태로 배치할 때 사용한다.  
테이블레이아웃을 사용하여 행과 열의 수를 정하고 그 안에 위젯을 배치하면 편리하다.

#### 속성

테이블레이아웃에서 설정되는 속성 중 `layout_span`, `layout_column`, `stretchColumns`가 있다.

- layout_span  
   열을 합쳐서 표시하라는 의미로.  
   `layout_span="2"` 는 현재 셀부터 2개의 셀을 합치라는 의미
- layout_column  
   지정된 열에 현재 위젯을 표시하라는 의미이다.
- stretchColumns  
   이는 `<TableLayout>` 자체에 설정하는 속성으로  
   지정된 열의 폭을 늘리라는 의미이다.  
   `strethColumns="*"`는 각 셀을 모두 같은 크기로 확장하여 전체 화면이 꽉 차는 효과를 낸다.
