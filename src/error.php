<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/common_2.css">
  <link rel="stylesheet" href="./css/error.css">
  <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="container_box">
            <div class="pop_up_box">
                <div class="pop_up_content">
                    <p><?php echo $th->getMessage() ?></p>
                    <p>요청 하신 페이지를 찾을 수 없으니,</p>
                    <p>메인으로 돌아가주세요.</p>
                </div>
            </div>
            <div class="pop_up_btn_box">    
                <a href="main.php"><button class="insert_btn">메인 페이지로 돌아가기</button></a>
            </div>
        </div>
    </div>
</body>
</html>