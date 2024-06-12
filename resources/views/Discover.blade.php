<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>言論統制SNS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #1da1f2;
            color: #fff;
            padding: 10px 20px;
            text-align: center;
        }
        nav {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }
        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }
        nav ul li {
            display: inline;
            margin-right: 20px;
        }
        nav ul li a {
            color: #fff;
            text-decoration: none;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
        }
        .post {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 20px;
        }
        .post p {
            margin: 5px 0;
        }
        .post img {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
        }
        .post button {
            background-color: #1da1f2;
            color: #fff;
            border: none;
            padding: 8px 15px;
            cursor: pointer;
        }
        .post button:hover {
            background-color: #0d8ddb;
        }
    </style>
</head>
<body>
    <header>
        <h1>言論統制SNS</h1>
    </header>

    <nav>
        <ul>
            <li><a href="#">ホーム</a></li>
            <li><a href="#">プロフィール</a></li>
            <li><a href="#">通知</a></li>
            <li><a href="#">メッセージ</a></li>
        </ul>
    </nav>

    <div class="container" id="postContainer"></div>

	<script>

    fetch('/discover-data')
        .then(response => response.json())
        .then(data => {
            var container = document.getElementById('postContainer');
            data.forEach(function(post) {
                var postElement = document.createElement('div');
                postElement.className = 'post';

                var contentText = document.createElement('p');
                contentText.textContent = post.content;
                postElement.appendChild(contentText);

                var userName = document.createElement('p');
                userName.textContent = '投稿者: ' + post.userName;
                postElement.appendChild(userName);

                var likeButton = document.createElement('button');
                likeButton.textContent = 'いいね';
                postElement.appendChild(likeButton);

                container.appendChild(postElement);
            });
        })
        .catch(error => console.error('Error:', error));
</script>
</body>
</html>
