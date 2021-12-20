
<?php
mb_language("Japanese");
mb_internal_encoding("UTF-8");

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    // POSTでのアクセスでない場合
    $name = '';
    $email = '';
    $subject = '';
    $message = '';
    $err_msg = '';
    $complete_msg = '';

} else {
    // フォームがサブミットされた場合（POST処理）
    // 入力された値を取得する
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // エラーメッセージ・完了メッセージの用意
    $err_msg = '';
    $complete_msg = '';

    // 空チェック
    if ($name == '' || $email == '' || $subject == '' || $message == '') {
        $err_msg = '全ての項目を入力してください。';
    }
    
    // エラーなし（全ての項目が入力されている）
    if ($err_msg == '') {
        $to = " "; // 管理者のメールアドレス(送信先)
        // Yudaiより下記を追加
        $from = "Amy <" . $email . ">";

        // Yudaiより下記の1行変更
        // $headers = "From: " . $email . "\r\n"
        // Yudaiより下記を追加
        // 下記コメントアウトはコードの説明
            // Content-Type – メール形式
            // Return-Path – 送信先メールアドレスが受け取り不可の場合に、エラー通知のいくメールアドレス
            // From – 送信者の名前（または組織名）とメールアドレス
            // Sender – 送信者の名前（または組織名）とメールアドレス
            // Reply-To – 受け取った人に表示される返信の宛先
            // Organization – 送信者名（または組織名）
            // X-Sender – 送信者のメールアドレス
            // X-Priority – メールの重要度を表す
        $headers = '';
        $header .= "Content-Type: text/plain \r\n";
        $header .= "Return-Path: " . $to . " \r\n";
        $header .= "From: " . $from ." \r\n";
        $header .= "Sender: " . $from ." \r\n";
        $header .= "Reply-To: " . $email . " \r\n";
        $header .= "Organization: " . $name . " \r\n";
        $header .= "X-Sender: " . $email . " \r\n";
        $header .= "X-Priority: 3 \r\n";


        // 本文の最後に名前を追加
        $message .= "\r\n\r\n" . $name;

        // メール送信
        mb_send_mail($to, $subject, $message, $headers);

        // 完了メッセージ
        $complete_msg = "送信が完了いたしました！<br>お問い合わせいただき、ありがとうございます。<br>内容を確認し、3日営業日以内にメールにてご返信させていただきます。<br>今しばらく、お待ちくださいませ。";

        // 全てクリア
        $name = '';
        $email = '';
        $subject = '';
        $message = '';
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Belle | Belleについて</title>
  <link rel="stylesheet" href="css/ress.css">
  <link rel="stylesheet" href="css/common.css">
  <link rel="stylesheet" href="css/hamburger.css">
  <link rel="stylesheet" href="css/contact.css">
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">

  <meta name="description" content="">

  <!-- google fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Arizonia&family=Cormorant+Infant:wght@300&family=Crimson+Text&family=Zen+Old+Mincho&display=swap" rel="stylesheet">


  <!-- font awesome -->
  <script src="https://kit.fontawesome.com/931c5e739a.js" crossorigin="anonymous"></script>

  <!-- jQuery読み込み -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <!-- ハンバーガーメニュー -->
  <script>
      $(function() {
        $('.open_line').on("click", function(){
    
        $(this).toggleClass('open');
        $('#gnav').toggleClass('open');
      });
    });
    
    // メニューをクリックされたら、非表示にする
    $(function() {
      $('.gnav-menu li a').on("click", function(){
        $('#gnav').removeClass('open');
      });
    });
  </script>


  <!-- トップへのスムーズスクロールJS -->
  <script>
    $(function(){
      $('a[href^="#"]').click(function(){
        let speed = 500;
        let href= $(this).attr("href");
        let target = $(href == "#" || href == "" ? 'html' : href);
        let position = target.offset().top;
        $("html, body").animate({scrollTop:position}, speed, "swing");
        return false;
      });
    });
    
  </script>

  <!-- 各コンテンツをふっわっと表示させるJS -->
  <script>
    window.onload = function() {
      scroll_effect();

      $(window).scroll(function(){
      scroll_effect();
    });

    function scroll_effect(){
      $('.effect-fade').each(function(){
        var elemPos = $(this).offset().top;
        var scroll = $(window).scrollTop();
        var windowHeight = $(window).height();
        if (scroll > elemPos - windowHeight){
        $(this).addClass('effect-scroll');
        }
      });
      }
    };
  </script>


</head>
<body>

  <header id="header">

    <!-- top logo -->
    <section class="top-logo">
      <a href="index.html">
        <img src="img/toplogo name.png" alt="Belle main logo">
      </a>
    </section>

    <!-- nav -->
    <section class="header-right">
      <nav id="nav">

        <li>
          <a href="index.html"><span>TOP</span></a>
        </li>

        <li>
          <a href="about.html" target="_blank" rel="noopener"><span>Belleについて</span></a>
        </li>

        <li>
          <a href="course.html" target="_blank" rel="noopener"><span>コース料金</span></a>
        </li>

        <li>
          <a href="faq.html" target="_blank" rel="noopener"><span>よくある質問</span></a>
        </li>

        <li>
          <a href="contact.php" target="_blank" rel="noopener"><span>お問い合わせ</span></a>
        </li>

      </nav>
    </section>

    <!-- ハンバーガーメニュー -->
    <div id="hamburger">
      <section>
        <div class="open_line" id="btnA">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </section>

      <!--ハンバーガー内のグロナビ-->
      <nav id="gnav">
        <div class="gnav-menu">

          <div class="gnav-img"><img src="img/toplogo.png" alt="Belle gnav logo"></div>

          <ul>
            <li>
              <a href="index.html" target="_blank" rel="noopener"><span>TOP Page<br>Topページへ</span></a>
            </li>
            
            <li>
              <a href="about.html" target="_blank" rel="noopener"><span>About Belle<br>ベルについて</span></a>
            </li>
    
            <li>
              <a href="course.html" target="_blank" rel="noopener"><span>Course<br>コースと料金</span></a>
            </li>
    
            <li>
              <a href="faq.html" target="_blank" rel="noopener"><span>FAQ<br>よくある質問</span></a>
            </li>
    
            <li>
              <a href="contact.php" target="_blank" rel="noopener"><span>Contact<br>お問い合わせ</span></a>
            </li>

          </ul>

          <!-- ハンバーガーお問い合わせボタン -->
          <section class="contact">
       
          </section>
        </div>

        <!--ハンバーガー内SNSセクション-->
        <ul>

          <li class="li-02 hamburger-sns">
            <!-- インスタグラム -->
            <a href="https://www.instagram.com/privatesalon_belle_/?hl=ja" class="sns-btn" target="_blank" rel="noopener"><i class="fab fa-instagram"></i></a>
  
            <!-- ラインアカウント -->
            <a href="https://line.me/ti/p/%ライン＠のアカウント" class="sns-btn" target="_blank" rel="noopener"><i class="fab fa-line"></i></a>
  
            <!-- メールフォーム -->
            <a href="mailto:info@tiele-inc.com" class="sns-btn"><i class="far fa-envelope" target="_blank" rel="noopener"></i></a>
          </li>
        </ul>
      </nav>
    </div>

  </header>

  <main id="main">

    <!-- h1共通 -->
    <section class="top-title">
      <h1>Contact</h1>
      <p class="">-お問い合わせ-</p>
    </section>

    <?php if ($err_msg != ''): ?>
        <div class="alert alert-danger">
    <?php echo $err_msg; ?>
        </div>
    <?php endif; ?>

    <?php if ($complete_msg != ''): ?>
        <div class="alert alert-success">
            <?php echo $complete_msg; ?>
        </div>
    <?php endif; ?> 
          
    <form class="form effect-fade" method="post">

      <!-- 左側 画像 -->
      <li class="form-left">
        <img src="img/beauty-lady.jpg" alt="contact form image">
      </li>

      <li class="form-right">
        
          <!-- Name -->
        <div class="txt-area">
          <p>お名前</p>
          <input type="text"  name="name"  value="<?php echo $name; ?>">
        </div>
        

        <!-- Email -->
        <div class="txt-area">
          <p>メールアドレス</p>
          <input type="text"  name="email"  value="<?php echo $email; ?>">
        </div>
        

        <!-- Subject -->
        <div class="txt-area">
          <p>件名</p>
          <input type="text"  name="subject" value="<?php echo $subject; ?>">
        </div>
        

        <!-- Content -->
        <div class="txt-area">
          <p>お問い合わせ内容</p>
        <textarea  name="message" rows="5" ><?php echo $subject; ?></textarea>
        </div>
        

        <div class="sent-btn">
          <button type="submit">Submit</button>
        </div>

      </li>

    </form> 

    
  </main>

  <footer id="footer" class="effect-fade">
    <!-- Footer コンタクトセクション -->
    <section class="contact contents">
      <div class="contact-flex">
        <li class="li-01">
          <h1>Company</h1>
          <p>- 会社概要 -</p>
        </li>

        <li class="li-01">
          <dl>
            <dt>ADO</dt>
            <dd class="under-line">福岡市博多区博多駅東1丁目1-30 
              第一高田ビル501<a href="" target="_blank" rel="noopener">VIEW MAP</a></dd>
            <dt>TEL</dt>
            <dd class="under-line"><a href="tel:092-260-7106" target="_blank" rel="noopener">092-260-7106</a></dd>
            <dt>EMAIL</dt>
            <dd class="under-line"><a href="mailto:info@tiele-inc.com" target="_blank" rel="noopener">info@tiele-inc.com</a></dd>
          </dl>
        </li>

        <!-- SNSボタン・お問い合わせボタン -->
        <li class="li-02">
          <!-- インスタグラム -->
          <a href="https://www.instagram.com/privatesalon_belle_/?hl=ja" class="sns-btn" target="_blank" rel="noopener"><i class="fab fa-instagram"></i></a>

          <!-- ラインアカウント -->
          <a href="https://line.me/ti/p/%ライン＠のアカウント" class="sns-btn" target="_blank" rel="noopener"><i class="fab fa-line"></i></a>

          <!-- メールフォーム -->
          <a href="mailto:info@tiele-inc.com" class="sns-btn"><i class="far fa-envelope" target="_blank" rel="noopener"></i></a>

          <!-- お問い合わせボタン -->
          <div class="contact-btn btn effect-fade">
            <a href="contact.php" target="_blank" rel="noopener">お問い合わせフォームへ</a>
          </div>

        </li>
      </div>

    </section>
    <section class="copy-right">
      ©︎2021, PRIVATE SALON BELLE, ALL RUGHTS RESERVED.
    </section>
  </footer>
  
</body>
</html>
