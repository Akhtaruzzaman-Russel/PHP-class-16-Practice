<?php 
include 'connection.php';
?>

<div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Add New Post</h4>
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                                <div class="icon-item">
                                                    <i data-feather="list"></i>
                                                    <i data-feather="layers"></i>
                                                    <a href="">ALL POSTS</a>
                                                </div>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->  

        <?php
            if(isset($_POST['add_post'])){
                $post_date = $_POST['post_date'];
                $post_title = $_POST['post_title'];
                $post_description= $_POST['post_description'];
                $post_author = $_POST['post_author'];
              
                $post_image = "";
                $post_image_tmp = $_FILES['post_image']['tmp_name'];
                $post_image = 'author'.time().'_'.rand(10000, 100000000).'.'.pathinfo($_FILES['post_image']['name'], PATHINFO_EXTENSION);
                $post_category = $_POST['post_category'];
                $post_tags = $_POST['post_tags'];

                $sql = " INSERT INTO posts (post_title, post_description, post_author, post_thumb, post_category, post_tags, post_date) 
                VALUES ('$post_title', '$post_description', '$post_author', '$post_image',  '$post_category', '$post_tags', '$post_date')";
                
                $add_new_post = mysqli_query($conn, $sql);
                
                if($add_new_post){
                    move_uploaded_file($post_image_tmp, "images/".$post_image);
                    echo "<script>alert('Post Added Successfully')</script>";

                }else{
                   die('Failed to Add New Post'.mysqli_error($conn));
                }
            }
        
        ?>

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <!-- <h4 class="header-title mt-0">Input Types</h4>
                                        <p class="sub-header">
                                            Most common form control, text-based input fields. Includes support for all HTML5 types: <code>text</code>, <code>password</code>, <code>datetime</code>, <code>datetime-local</code>, <code>date</code>, <code>month</code>, <code>time</code>, <code>week</code>, <code>number</code>, <code>email</code>, <code>url</code>, <code>search</code>, <code>tel</code>, and <code>color</code>.
                                        </p> -->

                                        <form class="form " action="" method="post" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-md-10 offset-1">
                                                        <div class="mb-3 row">
                                                            <label class="col-lg-2 col-form-label" for="post_date">Post Date</label>
                                                            <div class="col-lg-10">
                                                                <input type="date" name="post_date" required autocomplete="off" class="form-control" value="">
                                                            </div>
                                                        </div>

                                                    <script>
                                                        document.addEventListener('DOMContentLoaded', function() {
                                                            const today = new Date().toISOString().split('T')[0];
                                                            document.querySelector('input[name="post_date"]').value = today;
                                                        });
                                                    </script>

                                                    <div class="mb-3 row">
                                                        <label class="col-lg-2 col-form-label" for="example-email">Post Title</label>
                                                        <div class="col-lg-10">
                                                            <input type="text" id="example-email" name="post_title" class="form-control" >
                                                        </div>
                                                    </div>
  

                                                    <div class="mb-3 row">
                                                        <label class="col-lg-2 col-form-label" for="example-textarea">Post Content</label>
                                                        <div class="col-lg-10">
                                                            <textarea class="form-control" rows="5" id="post_content" name="post_description"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label class="col-lg-2 col-form-label">Post Author</label>
                                                        <div class="col-lg-10">
                                                            <input type="text" name="post_author" class="form-control"  >
                                                        </div>
                                                    </div>


                                                    <div class="mb-3 row">
                                                        <label class="col-lg-2 col-form-label" for="post_category">Post Category</label>
                                                        <div class="col-lg-10">
                                                            <select name="post_category" class="form-select" required>
                                                                <option>Please Select the Post Category</option>

                                                                    <?php
                                                                        $query = "SELECT * FROM categories";
                                                                        $category = mysqli_query($conn, $query);
                                                                        
                                                                        while($row = mysqli_fetch_assoc($category)) {
                                                                                $cat_id = $row ['cat_id'];
                                                                                $cat_name = $row ['cat_name'];
                                                                                echo "<option value='$cat_id'>$cat_name</option>";
                                                         
                                                                        }
                                                                    
                                                                    ?>

                                                                <!-- <option>2</option>
                                                                <option>3</option>
                                                                <option>4</option>
                                                                <option>5</option> -->
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3 row">
                                                        <label class="col-lg-2 col-form-label" for="example-fileupload">Post Image</label>
                                                        <div class="col-lg-10">
                                                            <input type="file" name="post_image" required autocomplete="off" class="form-control-file" id="example-fileupload">
                                                        </div>
                                                    </div>

                                                    <!-- Post Tags -->
                                                     <div class="mb-3 row">
                                                        <label class="col-lg-2 col-form-label" for="example-tags">Post Tags</label>
                                                        <div class="col-lg-10">
                                                            <input type="text" name="post_tags" class="form-control tags" id="example-tags" placeholder="Add tags...">
                                                        </div>
                                                    </div>
                                                    <!-- Submit Button -->
                                                     <div class="row mb-0 justify-content-end">
                                                        <div class="col-6">
                                                            <button type="submit" class="btn btn-primary" name="add_post">Submit</button>
                                                        </div>
                                                    </div>

                                                    
                                                </div>
      
                                            </div>
                                        </form>
            
                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div><!-- end col -->
                        </div>
                        <!-- end row -->


                        <!-- end row -->

                        
                        <!-- Floating Label -->



                        <!-- end row -->

                        <!-- Inline Form -->

                        <!-- end row -->

                        
                    </div> <!-- container -->

                </div> <!-- content -->



            </div>