<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
   require APPROOT . '/views/includes/navigation.php';
?>
<div class="container">


    <!-- Page header end -->

    <!-- Content wrapper start -->
    <div class="content-wrapper">

        <!-- Row start -->
        <div class="row gutters">

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                <div class="card m-0">

                    <!-- Row start -->
                    <div class="row no-gutters">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-3 col-3">
                            <div class="users-container">
                                <ul class="users">
                                    <?php foreach ($data['users'] as $key => $user) :?>
                                    <li class="person" id="<?php echo $user->id ?>" data-chat="person<?php echo $key ?>">
                                        <div class="user">
                                            <img src="../public/img/profile-img.png">
                                            <?php if($user->is_online) : ?>
                                                <span class="status busy"></span>
                                            <?php endif ?>
                                        </div>
                                        <p class="name-time">
                                            <span class="name"><?php echo $user->email ?></span>
                                        </p>
                                    </li>
                                    <?php endforeach?>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-9 col-9 conversation">
                            <div class="selected-user">
                               
                            </div>
                            <div class="chat-container">
                                <ul class="chat-box chatContainerScroll">
                                </ul>
                                <div class="form-group mt-3 mb-0 block-send-message">
                                    <input type="hidden" id="to-user">
                                    <textarea class="form-control" id="message" rows="3" placeholder="Message..."></textarea>
                                    <button  type="submit" class="btn" id="sendMessage"><i class="fa fa-paper-plane"></i></button>
                                    <div class="alert alert-danger errorMessage" role="alert">Merci de saisir votre message.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Row end -->
                </div>

            </div>

        </div>
        <!-- Row end -->

    </div>
    <!-- Content wrapper end -->

</div>
