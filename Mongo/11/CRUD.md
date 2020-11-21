# Commands in Shell

> collection 이름이 `posts` 입니다

# Create : insert Data

## db.posts.insert()

```jsx
db.posts.insert({
	title: "Post One",
	body: "Body of post one",
	category: "News",
	likes: 4,
	tags: ["news", "events"],
	users: {
		name: "John",
		status: "author"
	},
	date: Date()
});
```

## db.posts.insertMany()

```jsx
db.posts.insertMany([
	{
		title: "Post Two",
		body: "Body of post two",
		category: "Technology",
		data: Date()
	},
	{
		title: "Post Three",
		body: "Body of post three",
		category: "News",
		data: Date()
	},
	{
		title: "Post Four",
		body: "Body of post Four",
		category: "Entertainment",
		data: Date()
	}
]);
```

# Read: find Data

## db.posts.find()

sql 의 where 절과 비슷하다.

```jsx
db.posts.find(); // raw text
db.posts.find().pretty(); // 보기 편하게

// 카테고리가 News인 애들만
db.posts.find({ category: "News" }).pretty();
```

## db.posts.findOne()

sort()와 pretty(), limit을 같이 쓸 수 없다.

```jsx
// 카테고리가 News인 애들 중 첫번째
db.posts.findOne({ category: "News" });
```

## methods

### db.posts.find().sort()

```jsx
// title을 기준으로 오름차순
db.posts.find().sort({ title: 1 }).pretty();

// title을 기준으로 내림차순
db.posts.find().sort({ title: 1 }).pretty();
```

### db.posts.find().count()

해당 데이터가(document) 몇개인지 세주는 함수

```jsx
// 카테고리가 News 인 document가 몇개인지
db.posts.find({ category: "News" }).count();
```

### db.posts.find().limit()

```jsx
// 2개만
db.posts.find().limit(2);

// 정렬한 뒤 2개만
db.posts.find().sort({ title: 1 }).limit(2);
```

### forEach()

```jsx
db.posts.find().forEach(function (doc) {
	print("Blog Post: " + doc.title);
});
```

## 조건부

```jsx
// views 값이 3 보다 큰 document 를 조회
db.posts.find({
	views: {
		$gt: 3 // <-> $lt
	}
});

// views 값이 3 보다 크거나 같은 document 를 조회
db.posts.find({
	views: {
		$gte: 3 // <-> $lte
	}
});
```

# Update: update data

### upsert

```jsx
// 수정할 대상이 없으면 추가 update + insert
db.posts.update(
	{ title: "Post Two" },
	{
		title: "Post Two",
		body: "New posts 2 body",
		date: Date()
	},
	{
		upsert: true
	}
);
```

### $set

```jsx
// 나머지는 유지
// $set 을 안 주게 되면 다른 document는 다 삭제
db.posts.update(
	{ title: "Post Two" },
	{
		$set: {
			body: "body of post 2",
			category: "Technology"
		}
	}
);
```

### $inc

```jsx
// 증가시키면서 update
db.posts.update(
	{ title: "Post One" },
	{
		$inc: { likes: 2 }
	}
);
```

### $rename

```jsx
// KEY 이름을 변경할 수 있습니다.
db.posts.update(
	{ title: "Post One" },
	{
		$rename: {
			like: "views"
		}
	}
);
```

## Delete: delete data

## db.posts.remove()

```jsx
// db.collectionName.remove(조건)
db.posts.remove({ title: "Post Four" });
```
