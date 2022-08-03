<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Pythonic lava</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,900">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="assets/css/Animation-Cards-1.css">
    <link rel="stylesheet" href="assets/css/Animation-Cards.css">
    <link rel="stylesheet" href="assets/css/Button-Modal-popup-team-member-1.css">
    <link rel="stylesheet" href="assets/css/Button-Modal-popup-team-member.css">
    <link rel="stylesheet" href="assets/css/Continue-Button.css">
    <link rel="stylesheet" href="assets/css/Customizable-Carousel-swipe-enabled.css">
    <link rel="stylesheet" href="assets/css/Hero-Features.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="assets/css/Login-Animate.css">
    <link rel="stylesheet" href="assets/css/Pretty-Registration-Form.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/Ultimate-Accordion-with-caret-icon.css">
    <link rel="stylesheet" href="assets/css/Ultimate-Sidebar-Menu-BS5.css">
</head>

<body>
    <div><a class="btn btn-primary btn-customized open-menu" role="button" style="margin-top: 2px;padding-top: 9px;padding-bottom: 10px;margin-right: 1687px;"><i class="fa fa-navicon"></i>&nbsp;Menu</a>
        <div class="sidebar" style="background: rgb(33,37,41);"><img class="rounded" loading="lazy" src="assets/img/bs4_team_01.jpg" style="text-align: center;border-style: none;transform: scale(0.97);max-height: 100px;max-width: 100px;margin-left: 60px;margin-top: 19px;">
            <div class="dismiss"><i class="fa fa-caret-left"></i></div>
            <div class="brand" style="padding: 15px 20px;">
                <h5 class="text-start">Name Surname</h5>
            </div>
            <nav class="navbar navbar-dark navbar-expand">
                <div class="container-fluid">
                    <ul class="navbar-nav flex-column me-auto">
                        <li class="nav-item">
                            <div class="accordion bg-dark bg-gradient border rounded border-1 border-dark shadow-lg" role="tablist" id="accordion-1" style="width: 214px;margin-left: -12px;margin-top: 28px;">
                                <div class="accordion-item">
                                    <?php

                                    include './config/connection.php';

                                    #get all week names and ids from database and display them in the menu
                                    $sql = "SELECT * FROM weeks";
                                    $result = $conn->query($sql);
                                    $week_names = array();
                                    $week_id = array();
                                    $weekCounter = 0;
                                    $lesson_id = array();
                                    $content_id = array();
                                    $lesson_title = array();



                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $week_names[] = $row['week_name'];
                                            $week_id[] = $row['id'];
                                        }
                                    }


                                    #loop to loop though all week names and display them in the menu
                                    foreach ($week_names as $week) {

                                        #get content id for current week from database
                                        $sql = "SELECT * FROM content WHERE week_id = '$week_id[$weekCounter]'";
                                        $result = $conn->query($sql);
                                        $content_id = array();

                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                $content_id[] = $row['id'];
                                            }
                                        }

                                        #loop to collect lesson_title from content table for current week and store it in an array
                                        $lesson_title = array();
                                        $lesson_id = array();
                                        foreach ($content_id as $id) {
                                            $sql = "SELECT * FROM content WHERE id = '$id'";
                                            $result = $conn->query($sql);
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    $lesson_title[] = $row['lesson_title'];
                                                    $lesson_id[] = $row['id'];
                                                }
                                            }
                                        }

                                        $content_id_counter = 0;

                                        echo "<h2 class='accordion-header' role='ta''>
    <button class='accordion-button border rounded border-1 border-dark shadow-lg' data-bs-toggle='collapse' data-bs-target='#accordion-1 .item-" . $weekCounter . "' aria-expanded='true' aria-controls='accordion-1 .item-" . $weekCounter . "' style='color: rgb(255,255,255);background: rgb(59,59,59);'>" . $week_names[$weekCounter] . "</button></h2>
    <div class='accordion-collapse collapse item-" . $weekCounter . " bg-dark' role='tabpanel' data-bs-parent='#accordion-1'>
        <div class='accordion-body'>
            <form>";

                                        foreach ($lesson_title as $title) {

                                            echo "<div class='form-check'>
                          <input id='formCheck-1' class='form-check-input' type='radio'  value = ' $content_id[$content_id_counter]' name='week_" . $weekCounter . "' />
                          <label class='form-check-label' for='formCheck-1' style='color: rgb(0,0,0);'>" . $title . " </label><label style='margin-left : 10px' hidden>(Visited)</label>
                      </div>";
                                            $content_id_counter++;
                                        }

                                        echo "  </form>
      </div>
  </div>";

                                        $weekCounter++;
                                    }



                                    ?>
                                </div>
                            </div>
                            <hr style="margin: 25px 0px 16px;margin-top: 31px;">
                        </li>
                        <li class="nav-item">
                            <div id="Modal-button-wrapper-1" class="text-center"><a class="shadow-sm bs4_modal_trigger" href="Hall of fame.php" data-modal-id="bs4_team" style="color: rgb(255,255,255);">hall of fame</a>
                                <hr style="margin: 25px 0px 16px;margin-top: 31px;">
                            </div>
                        </li>
                        <li class="nav-item"><a class="btn btn-primary text-truncate shadow float-end tenant-continue-btn" role="button" data-bss-hover-animate="pulse" style="margin-right: 45px;margin-top: 99px;background: rgba(51,51,51,0.2);width: 103px;" href="login.php">Log out&nbsp;<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-logout continue-icon" style="transform: scale(1.09);">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path>
                                    <path d="M7 12h14l-3 -3m0 6l3 -3"></path>
                                </svg></a></li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="overlay"></div>
    </div>
    <nav class="navbar navbar-dark navbar-expand-md textwhite bg-dark text-white shadow-lg py-3" style="transform-style: preserve-3d;opacity: 0.83;filter: brightness(160%) saturate(200%);background: rgb(33, 37, 41);">
        <div class="container"><a class="navbar-brand d-flex align-items-center" href="index.php"><span class="bs-icon-sm bs-icon-rounded bs-icon-primary d-flex justify-content-center align-items-center me-2 bs-icon"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-bezier">
                        <path fill-rule="evenodd" d="M0 10.5A1.5 1.5 0 0 1 1.5 9h1A1.5 1.5 0 0 1 4 10.5v1A1.5 1.5 0 0 1 2.5 13h-1A1.5 1.5 0 0 1 0 11.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zm10.5.5A1.5 1.5 0 0 1 13.5 9h1a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1-1.5 1.5h-1a1.5 1.5 0 0 1-1.5-1.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM6 4.5A1.5 1.5 0 0 1 7.5 3h1A1.5 1.5 0 0 1 10 4.5v1A1.5 1.5 0 0 1 8.5 7h-1A1.5 1.5 0 0 1 6 5.5v-1zM7.5 4a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1z"></path>
                        <path d="M6 4.5H1.866a1 1 0 1 0 0 1h2.668A6.517 6.517 0 0 0 1.814 9H2.5c.123 0 .244.015.358.043a5.517 5.517 0 0 1 3.185-3.185A1.503 1.503 0 0 1 6 5.5v-1zm3.957 1.358A1.5 1.5 0 0 0 10 5.5v-1h4.134a1 1 0 1 1 0 1h-2.668a6.517 6.517 0 0 1 2.72 3.5H13.5c-.123 0-.243.015-.358.043a5.517 5.517 0 0 0-3.185-3.185z"></path>
                    </svg></span><span>Pythonic lava</span></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-5"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-5">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="content.php">Content</a></li>
                    <li class="nav-item"><a class="nav-link" href="practice.php">Practice</a></li>
                    <li class="nav-item"><a class="nav-link" href="quiz.php">Quiz</a></li>
                    <li class="nav-item"><a class="nav-link active" href="assignments.php">Assignments</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Ask teacher</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container text-white" id="assignments_container" style="margin-top: 52px;">
        <h1 class="display-3 text-center">Assignments</h1>
        <div class="accordion bg-dark bg-gradient border rounded border-1 border-dark shadow-lg" role="tablist" id="accordion-2">
            <div class="accordion-item">
                <h2 class="accordion-header panel-title mb-0" role="tab"><button class="accordion-button text-center text-white bg-dark border rounded border-secondary shadow-lg collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-2 .item-1" aria-expanded="true" aria-controls="accordion-2 .item-1"><i class="fa fa-comments"></i>&nbsp;Week 1<br></button></h2>
                <div class="accordion-collapse collapse show item-1" role="tabpanel" data-bs-parent="#accordion-2">
                    <div class="accordion-body">
                        <p class="text-white"><strong>Answer:</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><label class="form-label text-white">Mark: Not Marked</label><button class="btn btn-primary text-truncate bg-dark border rounded border-light shadow-none float-end tenant-continue-btn" data-bss-hover-animate="pulse" type="button">Continue&nbsp;<i class="fas fa-greater-than continue-icon"></i></button>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header panel-title mb-0" role="tab"><button class="accordion-button collapsed text-center text-white bg-dark border rounded border-secondary shadow-lg collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-2 .item-2" aria-expanded="false" aria-controls="accordion-2 .item-2"><i class="fa fa-comments"></i>&nbsp;Week 2<br></button></h2>
                <div class="accordion-collapse collapse item-2" role="tabpanel" data-bs-parent="#accordion-2">
                    <div class="accordion-body">
                        <p class="text-white"><strong>Answer:</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><label class="form-label text-white">Mark: Not Marked</label><button class="btn btn-primary text-truncate bg-dark border rounded border-light shadow-none float-end tenant-continue-btn" data-bss-hover-animate="pulse" type="button">Continue&nbsp;<i class="fas fa-greater-than continue-icon"></i></button>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header panel-title mb-0" role="tab"><button class="accordion-button collapsed text-center text-white bg-dark border rounded border-secondary shadow-lg collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-2 .item-3" aria-expanded="false" aria-controls="accordion-2 .item-3"><i class="fa fa-comments"></i>&nbsp;Week 3<br></button></h2>
                <div class="accordion-collapse collapse item-3" role="tabpanel" data-bs-parent="#accordion-2">
                    <div class="accordion-body">
                        <p class="text-white"><strong>Answer:</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><label class="form-label text-white">Mark: Not Marked</label><button class="btn btn-primary text-truncate bg-dark border rounded border-light shadow-none float-end tenant-continue-btn" data-bss-hover-animate="pulse" type="button">Continue&nbsp;<i class="fas fa-greater-than continue-icon"></i></button>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header panel-title mb-0" role="tab"><button class="accordion-button collapsed text-center text-white bg-dark border rounded border-secondary shadow-lg collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-2 .item-4" aria-expanded="false" aria-controls="accordion-2 .item-4"><i class="fa fa-comments"></i>&nbsp;Week 4<br></button></h2>
                <div class="accordion-collapse collapse item-4" role="tabpanel" data-bs-parent="#accordion-2">
                    <div class="accordion-body">
                        <p class="text-white"><strong>Answer:</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><label class="form-label text-white">Mark: Not Marked</label><button class="btn btn-primary text-truncate bg-dark border rounded border-light shadow-none float-end tenant-continue-btn" data-bss-hover-animate="pulse" type="button">Continue&nbsp;<i class="fas fa-greater-than continue-icon"></i></button>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header panel-title mb-0" role="tab"><button class="accordion-button collapsed text-center text-white bg-dark border rounded border-secondary shadow-lg collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-2 .item-5" aria-expanded="false" aria-controls="accordion-2 .item-5"><i class="fa fa-comments"></i>&nbsp;Week 5<br></button></h2>
                <div class="accordion-collapse collapse item-5" role="tabpanel" data-bs-parent="#accordion-2">
                    <div class="accordion-body">
                        <p class="text-white"><strong>Answer:</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><label class="form-label text-white">Mark: Not Marked</label><button class="btn btn-primary text-truncate bg-dark border rounded border-light shadow-none float-end tenant-continue-btn" data-bss-hover-animate="pulse" type="button">Continue&nbsp;<i class="fas fa-greater-than continue-icon"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container" style="margin-top: 125px;">
        <div class="card" data-bss-hover-animate="pulse" style="width: 33rem;border-top-left-radius: 20px;border-top-right-radius: 20px;border-bottom-right-radius: 20px;border-bottom-left-radius: 20px;box-shadow: 5px 5px 16px 2px rgba(0,0,0,0.25);margin: 14px;min-width: 280px;max-width: 300px;margin-bottom: 20px;background: rgb(255,107,0);padding-right: 0px;transform: scale(1.25);margin-left: 279px;">
            <div style="width: 100%;height: 200px;background: url(&quot;assets/img/karytonndev_background.jpg&quot;) center / contain;border-top-left-radius: 20px;border-top-right-radius: 20px;"></div>
            <div class="card-body d-flex flex-column" style="height: 262px;text-align: center;margin-top: -17px;">
                <div>
                    <h4 class="display-5 text-dark" style="font-family: 'Source Sans Pro', sans-serif;font-weight: 700;color: rgb(255,160,0);">Too hard?</h4>
                </div><a class="align-self-end card-link" data-bss-hover-animate="pulse" href="#" style="padding: 4px;background: var(--bs-indigo);color: rgb(255,255,255);border-radius: 17px;padding-right: 14px;padding-left: 14px;padding-bottom: 6px;font-family: 'Source Sans Pro', sans-serif;margin-top: auto;transform: scale(1.22);margin-right: 10px;">Practice your code</a>
            </div>
        </div>
        <div class="card text-center" data-bss-hover-animate="tada" style="width: 33rem;border-top-left-radius: 20px;border-top-right-radius: 20px;border-bottom-right-radius: 20px;border-bottom-left-radius: 20px;box-shadow: 5px 5px 16px 2px rgba(0,0,0,0.25);margin: 14px;min-width: 280px;max-width: 300px;margin-bottom: 20px;background: rgb(255,0,122);padding-right: 0px;transform: scale(1.25);margin-left: 707px;margin-top: -32px;">
            <div style="width: 100%;height: 200px;background: url(&quot;assets/img/karytonndev_background.jpg&quot;) center / contain;border-top-left-radius: 20px;border-top-right-radius: 20px;"></div>
            <div class="card-body d-flex flex-column" style="height: 262px;text-align: center;margin-top: -15px;">
                <div>
                    <h4 class="display-5 text-dark" style="font-family: 'Source Sans Pro', sans-serif;font-weight: 700;color: rgb(255,160,0);">Too easy?</h4>
                </div><a class="align-self-end card-link" data-bss-hover-animate="pulse" href="#" style="padding: 4px;background: var(--bs-indigo);color: rgb(255,255,255);border-radius: 17px;padding-right: 14px;padding-left: 14px;padding-bottom: 6px;font-family: 'Source Sans Pro', sans-serif;margin-top: auto;transform: scale(1.22);margin-right: 7px;">Try some quiz&nbsp;</a>
            </div>
        </div>
    </div>
    <div id="footer">
        <footer class="text-white bg-dark" style="margin-top: 76px;">
            <div class="container py-4 py-lg-5" style="padding-top: 0;">
                <div class="row justify-content-center" style="margin-left: 0;margin-right: 0;">
                    <div class="col-sm-4 col-md-3 text-center text-lg-start d-flex flex-column item">
                        <h3 class="fs-6 text-white">Pages</h3>
                        <ul class="list-unstyled">
                            <li><a class="link-light" href="content.php">Content</a></li>
                            <li><a class="link-light" href="assignments.php">Assignment</a></li>
                            <li><a class="link-light" href="practice.php">Practice</a></li>
                            <li><a class="link-light" href="quiz.php">Quiz</a></li>
                            <li></li>
                        </ul>
                    </div>
                    <div class="col-sm-4 col-md-3 offset-xl-1 text-center text-lg-start d-flex flex-column item">
                        <h3 class="fs-6 text-white">Ask teacher</h3><textarea style="border-width: 2px;border-radius: 8px;" placeholder="Ask anything" wrap="soft" minlength="25"></textarea><button class="btn btn-primary" data-bss-hover-animate="pulse" type="submit" style="background: #360062;margin-right: 70px;margin-left: 70px;margin-top: 12px;">Submit</button>
                    </div>
                    <div class="col-lg-3 offset-xl-1 text-center text-lg-start d-flex flex-column align-items-center order-first align-items-lg-start order-lg-last item social">
                        <div class="fw-bold d-flex align-items-center mb-2"><span class="bs-icon-sm bs-icon-rounded bs-icon-primary d-flex justify-content-center align-items-center bs-icon me-2"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-bezier fs-5">
                                    <path fill-rule="evenodd" d="M0 10.5A1.5 1.5 0 0 1 1.5 9h1A1.5 1.5 0 0 1 4 10.5v1A1.5 1.5 0 0 1 2.5 13h-1A1.5 1.5 0 0 1 0 11.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zm10.5.5A1.5 1.5 0 0 1 13.5 9h1a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1-1.5 1.5h-1a1.5 1.5 0 0 1-1.5-1.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM6 4.5A1.5 1.5 0 0 1 7.5 3h1A1.5 1.5 0 0 1 10 4.5v1A1.5 1.5 0 0 1 8.5 7h-1A1.5 1.5 0 0 1 6 5.5v-1zM7.5 4a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1z"></path>
                                    <path d="M6 4.5H1.866a1 1 0 1 0 0 1h2.668A6.517 6.517 0 0 0 1.814 9H2.5c.123 0 .244.015.358.043a5.517 5.517 0 0 1 3.185-3.185A1.503 1.503 0 0 1 6 5.5v-1zm3.957 1.358A1.5 1.5 0 0 0 10 5.5v-1h4.134a1 1 0 1 1 0 1h-2.668a6.517 6.517 0 0 1 2.72 3.5H13.5c-.123 0-.243.015-.358.043a5.517 5.517 0 0 0-3.185-3.185z"></path>
                                </svg></span><span>Pythonic lava</span></div>
                        <p class="text-muted copyright">Coding hot</p>
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-between align-items-center pt-3">
                    <p class="mb-0">Copyright © 2022 Brand</p>
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-facebook">
                                <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"></path>
                            </svg></li>
                        <li class="list-inline-item"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-twitter">
                                <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"></path>
                            </svg></li>
                        <li class="list-inline-item"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-instagram">
                                <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"></path>
                            </svg></li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="assets/js/Customizable-Carousel-swipe-enabled.js"></script>
    <script src="assets/js/Button-Modal-popup-team-member.js"></script>
    <script src="assets/js/Ultimate-Sidebar-Menu-BS5.js"></script>
</body>

</html>