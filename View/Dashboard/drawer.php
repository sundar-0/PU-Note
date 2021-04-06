<div id="sidedrawer" class="mui--no-user-select">
<div id="sidedrawer-brand" class="mui--appbar-line-height">
  <span class="mui--text-title">PU Notes</span>
</div>
<div class="mui-divider"></div>
<ul>
<a href="profile.php">
  <li>
    <strong><i class="fas fa-user"></i> Profile</strong>
  </li>
</a>
<a href="newsandnotice.php">
  <li>   
    <strong><i class="fas fa-flag"></i> News and Notice <span class="mui--z5 mui--text-danger" style="padding: 2.5px;border-radius: 5px;"> 56 </span></strong>
   
  </li>
</a>
<a href="pastquestions.php">
  <li>
    <strong><i class="fas fa-question-circle"></i> Past Questions</strong>
  </li>
</a>
<a href="syllabus.php">
  <li>
    <strong><i class="fas fa-book-reader"></i> Syllabus</strong>
  </li>
</a>
<a href="notes.php">
  <li>
    <strong><i class="far fa-file-pdf"></i> Notes</strong>
  </li>
</a>
<a href="feedback.php">
  <li>
    <strong>   <i class="fas fa-comments"></i> Feedback</strong>
  </li>
</a>
<a href="logout.php">
  <li>
  <strong>  <i class="fas fa-sign-out-alt"></i> Logout</strong>
  </li>
  </a>
</ul>
</div>
<header id="header">
<div class="mui-appbar mui--appbar-line-height">
  <div class="mui-container-fluid">
    <a class="sidedrawer-toggle mui--visible-xs-inline-block mui--visible-sm-inline-block js-show-sidedrawer">☰</a>
    <a class="sidedrawer-toggle mui--hidden-xs mui--hidden-sm js-hide-sidedrawer">☰</a>
    <?php echo '<strong align="center">Welcome! '.$_SESSION['user_first_name'].' '.$_SESSION['user_last_name'].'</strong>'?>
  </div>
</div>
</header>
