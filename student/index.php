<?php require '../inc/config_student.php'; ?>
<?php require '../inc/views/template_head_start.php'; ?>
<?php require '../inc/views/template_head_end.php'; ?>
<?php require '../inc/views/base_head.php'; ?>

<?php
    require '../inc/connect_db.php';

    //Unset session data for quiz
    if (isset($_SESSION)) {
        unset($_SESSION['user_id']);
        unset($_SESSION['quiz_id']);
        unset($_SESSION['quiz_code']);
        unset($_SESSION['exam_id']);
        unset($_SESSION['quiz_type']);
    }

    //Set page and Get page name
    $_SESSION['page'] = 'fsjt';
    $pageName = getPageName($_SESSION['page']);
    $pageDesc = getPageDesc($_SESSION['page']);

    //default set user id
    $_SESSION['user_id'] = session_id();
        
    //Get quizzes data from db.
    $quizzes = getQuizzes($_SESSION['page']);
    
    $ratingsQuizzes = [];
    $selectionQuizzes = [];
    $rankingQuizzes = [];
    $miniMockTimedQuizzes = [];
    $miniMockUntimedQuizzes = [];
    $mockTimedQuizzes = [];
    $mockUntimedQuizzes = [];

    foreach($quizzes as $quiz) {
        switch($quiz['quiz_kind']) {
            case 'ratings':
                $ratingsQuizzes[] = $quiz;
                break;
            case 'selection':
                $selectionQuizzes[] = $quiz;
                break;
            case 'ranking':
                $rankingQuizzes[] = $quiz;
                break;
            case 'mini-mock':
                if ($quiz['quiz_type'] == 'untimed') {
                    $miniMockUntimedQuizzes[] = $quiz;
                } elseif ($quiz['quiz_type'] == 'timed') {
                    $miniMockTimedQuizzes[] = $quiz;
                }
                break;
            case 'mock':
                if ($quiz['quiz_type'] == 'untimed') {
                    $mockUntimedQuizzes[] = $quiz;
                } elseif ($quiz['quiz_type'] == 'timed') {
                    $mockTimedQuizzes[] = $quiz;
                }
                break;
        }
    }
?>
<!-- Page Content -->
<div class="content">
    <div class="row push">
        <div class="col-lg-3 col-md-3"></div>
        <div class="col-lg-6 col-md-6">
            <h3 class="block-header bg-primary-darker text-white">
                <?php echo $pageName; ?>
            </h3>
        </div>
        <div class="col-lg-3 col-md-3"></div>
    </div>
    <div class="row font-s13">
        <div class="col-lg-3 col-md-3"></div>
        <div class="col-lg-6 col-md-6">
            <div class="col-lg-12 col-md-12 push">
                <h5 class="text-black">
                   <?php echo $pageDesc; ?>
                </h5>
            </div>
            <div class="col-lg-12 col-md-12">
            <?php foreach($ratingsQuizzes as $quiz) { ?>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <a class="block block-link-hover3 submit-link" href="#" data-id="<?php echo $quiz['id']; ?>">
                        <img class="img-responsive" src="<?php echo $one->assets_folder; ?>/img/photos/ratings-sjt.jpg" alt="">
                        <div class="block-content text-center">
                            <h4 class="push-10"><?php echo $quiz['quiz_code']; ?></h4>
                        </div>
                    </a>
                </div>
            <?php } ?>
            </div>
            <div class="col-lg-12 col-md-12">
            <?php foreach($selectionQuizzes as $quiz) { ?>
                <div class="col-lg-4 col-md-4  col-sm-6 col-xs-12">
                    <a class="block block-link-hover3 submit-link" href="#" data-id="<?php echo $quiz['id']; ?>">
                        <img class="img-responsive" src="<?php echo $one->assets_folder; ?>/img/photos/selection-sjt.jpg" alt="">
                        <div class="block-content text-center">
                            <h4 class="push-10"><?php echo $quiz['quiz_code']; ?></h4>
                        </div>
                    </a>
                </div>
            <?php } ?>
            </div>
            <div class="col-lg-12 col-md-12">
            <?php foreach($rankingQuizzes as $quiz) { ?>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <a class="block block-link-hover3 submit-link" href="#" data-id="<?php echo $quiz['id']; ?>">
                        <img class="img-responsive" src="<?php echo $one->assets_folder; ?>/img/photos/ranking-sjt.jpg" alt="">
                        <div class="block-content text-center">
                            <h4 class="push-10"><?php echo $quiz['quiz_code']; ?></h4>
                        </div>
                    </a>
                </div>
            <?php } ?>
            </div>
            
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 push">
                <?php if ($one->project_name == 'fsjt' && $_SESSION['page'] == 'fsjt') { ?>
                <h5 class="text-black">
                    The minimocks below have 24 questions each - 8 from each section - and give you the opportunity to practise questions with exam timings. 
                    The timed versions last 30 minutes and explanations are available after you complete the exam. 
                    In the untimed version you can mark questions as you go along.
                </h5>
                <?php } elseif ($one->project_name == 'sample' && $_SESSION['page'] == 's-f-sjt') { ?>
                <h5 class="text-black">
                    The minimocks below have 6 questions - 2 from each section (ratings, selections, and rankings) - and give you the opportunity to practise questions with exam untimed.
                    In the untimed version you can mark questions as you go along.
                </h5>
                <?php } elseif ($one->project_name == 'sample' && $_SESSION['page'] == 's-msra') { ?>
                    <h5 class="text-black">
                    The minimocks below have 4 questions - 2 from each section (selections and rankings) - and give you the opportunity to practise questions with exam untimed.
                    In the untimed version you can mark questions as you go along.
                </h5>
                <?php } ?>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <?php foreach($miniMockTimedQuizzes as $quiz) { ?>
                            <a class="block block-rounded block-link-hover3 submit-link" href="#" data-id="<?php echo $quiz['id']; ?>">
                                <div class="block-content block-content-full clearfix" style="display:flex;">
                                    <i class="fa fa-2x fa-clock-o" style="padding-right:5px;"></i>
                                    <span class="quiz-code"><?php echo ucfirst($quiz['quiz_type']); ?> <?php echo $quiz['quiz_code']; ?></span>
                                </div>
                            </a>
                        <?php } ?>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <?php foreach($miniMockUntimedQuizzes as $quiz) { ?>
                            <a class="block block-rounded block-link-hover3 submit-link" href="#" data-id="<?php echo $quiz['id']; ?>">
                                <div class="block-content block-content-full clearfix" style="display:flex;">
                                    <span class="quiz-code"><?php echo ucfirst($quiz['quiz_type']); ?> <?php echo $quiz['quiz_code']; ?></span>
                                </div>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
            
            <?php if (count($mockTimedQuizzes) > 0 || count($mockUntimedQuizzes) > 0) { ?>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 push">
                <img class="quiz-logo" src="<?php echo $one->assets_folder; ?>/img/photos/sjtmock.jpg" title="logo" alt="logo" />
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 push">
                <h5 class="text-black">
                    We have a full professional dilemma mock paper. 
                    This consists of 50 SJT questions. 
                    The timed version lasts 95 minutes - explanations are available after you complete the whole exam. 
                    The untimed version contains the same questions, and can be marked as you go.
                </h5>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <?php foreach($mockTimedQuizzes as $quiz) { ?>
                            <a class="block block-rounded block-link-hover3 submit-link" href="#" data-id="<?php echo $quiz['id']; ?>">
                                <div class="block-content block-content-full clearfix" style="display:flex;">
                                    <i class="fa fa-2x fa-clock-o" style="padding-right:5px;"></i>
                                    <span class="quiz-code"><?php echo ucfirst($quiz['quiz_type']); ?> <?php echo $quiz['quiz_code']; ?></span>
                                </div>
                            </a>
                        <?php } ?>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <?php foreach($mockUntimedQuizzes as $quiz) { ?>
                            <a class="block block-rounded block-link-hover3 submit-link" href="#" data-id="<?php echo $quiz['id']; ?>">
                                <div class="block-content block-content-full clearfix" style="display:flex;">
                                    <span class="quiz-code"><?php echo ucfirst($quiz['quiz_type']); ?> <?php echo $quiz['quiz_code']; ?></span>
                                </div>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    <form id="quiz-form" name="quiz-form" action="welcome.php" method="post">
        <input type="hidden" name="quiz-id" id="quiz-id" value="" />
    </form>
</div>
<!-- END Page Content -->

<?php require '../inc/views/base_footer.php'; ?>

<?php require '../inc/views/template_footer_start.php'; ?>

<script type="text/javascript">
    $(document).ready(function() {
        $(".submit-link").click(function() {
            let quiz_id = $(this).data('id');
            if (!quiz_id) {
                return;
            }
            $("form#quiz-form input#quiz-id").val(quiz_id);
            $("form#quiz-form").submit();
        });
    });
</script>

<?php require '../inc/views/template_footer_end.php'; ?>