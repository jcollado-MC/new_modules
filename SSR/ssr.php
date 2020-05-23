<?php

    class ssr{

        static function show($id){
            $code = self::sidebar($id);
            $code .= self::filter();
            $code .= self::actions();
            $code .= self::content($id);

            return $code;
        }

        static function sidebar($cat_id ){

            switch ($cat_id){
                case 1: return self::sidebarTable();
                case 2: return self::sidebarMatrix();
                case 3: return self::sidebarGallery();
            }

            throw new exception("report-type not defined");
        }



        static function content($cat_id ){
            switch ($cat_id){
                case 1: return self::contentTable();
                case 2: return self::contentMatrix();
                case 3: return self::contentGallery();
            }

            throw new exception("report-type not defined");
        }

        static function sidebarTable(){
            global $myHeader;

            $code = "
            
           
        <div class=\"col-3\">

            <!-- Tab content -->

            <div class=\"col-12 tabs\">

                <h2>Table Settings</h2>
                
                
                <div class=\"search col-12\">
                    <i class=\"fas fa-search search-icon col-1\"></i>
                    <input class='col-11' type=\"text\" id=\"tableSearchInputSSR\" placeholder=\"Search\">
                    
                </div>
                
                <form>";

            $code .="
                    <div class=\"col-12 table-fields\" >

                        <label class=\"col-10\"> <h5>Base</h5></label>
                        <div class=\"col-2 row\">
                            
                                <input type=\"checkbox\" id=\"group1\">
                               
                        </div>

                        <hr class=\"col-12\">

                        <div class=\"col-12 group1\">
                            <label class=\"col-6\">
                                <input type='checkbox'>
                                Store Number
                            </label>
                            <label class=\"col-6\">
                                <input type='checkbox'>
                                Store
                            </label>
                            <label class=\"col-6\">
                                <input type='checkbox'>
                                Branch
                            </label>
                            <label class=\"col-6\">
                                <input type='checkbox'>
                                AIM
                            </label>
                            <label class=\"col-6\">
                                <input type='checkbox'>
                                Country
                            </label>
                        </div>
                    </div>";

            $code .="<div class=\"col-12 table-fields\">

                        <label class=\"col-10\"> <h5>Product</h5></label>
                        <div class=\"col-2 row\">
                            <label class=\"switch\">
                                <input type=\"checkbox\">
                                <span class=\"slider round\"></span>
                            </label>
                        </div>

                        <hr class=\"col-12\">



                        <div class=\"col-12\">
                            <label class=\"col-6\">
                                <input type='checkbox'>
                                Name
                            </label>
                            <label class=\"col-6\">
                                <input type='checkbox'>
                                Family
                            </label>
                        </div>
                        
                    </div>";
                    
            $code .="<div class=\"col-12  table-fields\">


                        <label class=\"col-10\"> <h5>Visit</h5></label>
                        <div class=\"col-2 row\">
                            <label class=\"switch\">
                                <input type=\"checkbox\">
                                <span class=\"slider round\"></span>
                            </label>
                        </div>

                        <hr class=\"col-12\">

                        <div class=\"col-12\">
                            <label class=\"col-6\">
                                <input type='checkbox' CHECKED>
                                Sales Rep
                            </label>
                            <label class=\"col-6\">
                                <input type='checkbox'>
                                Date
                            </label>
                            <label class=\"col-6\">
                                <input type='checkbox'>
                                Month
                            </label>
                        </div>
                     </div>";
                        
//<!--            <div class=\"col-12 row table-fields\">-->
//<!--                <label>-->
//<!--                    <h5>Sort By</h5>-->
//<!--                </label>-->
//<!--                <select class=\"col-6\">-->
//<!--                    <option>Store Number</option>-->
//<!--                    <option>Store</option>-->
//<!--                    <option>Visit Date</option>-->
//<!--                    <option>Activity</option>-->
//<!--                </select>-->
//<!--                <select class=\"col-5\">-->
//<!--                    <option>ascending</option>-->
//<!--                    <option>descending</option>-->
//<!--                </select>-->
//<!--                <i class=\"fas fa-times delete col-1\"></i>-->
//<!--                <button class=\"add\" >-->
//<!--                    <i class=\"fas fa-plus\"></i>-->
//<!--                </button>-->
//<!--            </div>-->
//
            $code .="</form>
                </div>

            
            <button id=\"save\">Save</button>
            <button id=\"delete\">Delete</button>
            <!--            TODO: Only show delete when saved!-->
        </div>";

            return $code;
        }

        static function sidebarMatrix(){
            global $myHeader;

            $code = "
            
            <div class=\"col-3\">

                <!-- Tab content -->
    
                <div class=\"col-12 tabs\">
    
                    <h2>Matrix Settings</h2>
                    <form>";


            $code .="   <div class=\"col-12 row matrix-fields\">
                            <label>
                                <h5>X-Axis <i class=\"fas fa-arrow-right\"></i></h5>
                            </label>
                            <select class=\"col-12\">
                                <option>Store Number</option>
                                <option>Store</option>
                                <option>Visit Date</option>
                                <option>Activity</option>
                            </select>
                        </div>";


            $code .="
                        <div class=\"col-12 row matrix-fields\">
                            <label>
                                <h5>Y-Axis <i class=\"fas fa-arrow-down\"></i></h5>
                            </label>
                            <select class=\"col-12\">
                                <option>Store Number</option>
                                <option>Store</option>
                                <option>Visit Date</option>
                                <option>Activity</option>
                            </select>
                        </div>";


            $code .="
    
                        <div class=\"col-12 row matrix-fields\">
                            <label>
                                <h5>Total</h5>
                            </label>
                            <select class=\"col-12\">
                                <option>Sum</option>
                                <option>Average</option>
                                <option>Count</option>
                                <option>Median</option>
                            </select>
                           
                        </div>";


            $code .= "
                    </form>
                </div>




                <button id=\"save\">Save</button>
                <button id=\"delete\">Delete</button>
                <!--            TODO: Only show delete when saved!-->
            </div>
            ";
            return $code;
        }

        static function sidebarGallery(){

            global $myHeader;

            $code = "
            <div class=\"col-3\">

                <div class=\"col-12 tabs\">
    
                    <h2>Gallery Settings</h2>
                    <form>";

            $code .="   <div class=\"col-12 row gallery-fields\">
                            <label  class=\"col-11\">
                                <h5>Group Title</h5>
                            </label>
                            <button class=\"add col-1\" >
                                <i class=\"fas fa-plus\"></i>
                            </button>
                            <hr class='col-12'>
                            <select class=\"col-11\">
                                <option>Store Number</option>
                                <option>Store</option>
                                <option>Visit Date</option>
                                <option>Activity</option>
                            </select>
                            <i class=\"fas fa-times delete col-1\"></i>
                        
                        </div>";


            $code .="   <div class=\"col-12 row gallery-fields\">
                            <label  class=\"col-11\">
                                <h5>Image Title</h5>
                            </label>
                            <button class=\"add col-1\" >
                                <i class=\"fas fa-plus\"></i>
                            </button>
                            <hr class='col-12'>
                            <select class=\"col-11\">
                                <option>Store Number</option>
                                <option>Store</option>
                                <option>Visit Date</option>
                                <option>Activity</option>
                            </select>
                            <i class=\"fas fa-times delete col-1\"></i>
                           
                        </div>";
    
            $code.="   <div class=\"col-12 row gallery-fields\">
                            <label  class=\"col-11\">
                                <h5>Image Text</h5>
                            </label>
                            <button class=\"add col-1\" >
                                <i class=\"fas fa-plus\"></i>
                            </button>
                            <hr class='col-12'>
                            <select class=\"col-11\">
                                <option>Store Number</option>
                                <option>Store</option>
                                <option>Visit Date</option>
                                <option>Activity</option>
                            </select>
                            <i class=\"fas fa-times delete col-1\"></i>
                           
                        </div>";

            $code.="    <div class=\"col-12 row gallery-fields\">
                            <label  class=\"col-11\">
                                <h5>Image Subtitle</h5>
                            </label>
                            <button class=\"add col-1\" >
                                <i class=\"fas fa-plus\"></i>
                            </button>
                            <hr class='col-12'>
                            <select class=\"col-11\">
                                <option>Store Number</option>
                                <option>Store</option>
                                <option>Visit Date</option>
                                <option>Activity</option>
                            </select>
                            <i class=\"fas fa-times delete col-1\"></i>
                        </div>";

            $code .="   
                    </form>
                </div>
                <button id=\"save\">Save</button>                
                <button id=\"delete\">Delete</button>
                <!--            TODO: Only show delete when saved!-->
            </div>";

            return $code;
        }


        static function filter(){

            $code = "
            <div class=\"report-content col-9\">
                <div class=\"row col-9 filters\">";

            $code .= "
                    <div class=\"dropdown\">
                        <button onclick=\"dropdownFunction('timespan')\" class=\"dropbtn\"><h5>Timespan <i class=\"fas fa-caret-down\"></i></h5> </button>
                        <div class=\"dropdown-content\" id=\"timespan\">
                            <div class=\"col-12 row\">
                                <label>
                                    <input type=\"checkbox\" name=\"timespan\" >
                                    Moving Timespan
                                </label>
    
                                <div class=\"col-12\">
                                    <label>From</label>
                                    <input type=\"date\">
                                </div>
                                <div class=\"col-12\">
                                    <label>To</label>
                                    <input type=\"date\">
                                </div>
                                <!--TODO: If moving Timespan is active-&ndash;&gt;-->
                                <!--                    <select class=\"col-12\">-->
                                <!--                        <option>yesterday</option>-->
                                <!--                        <option>last week</option>-->
                                <!--                        <option>last month</option>-->
                                <!--                        <option>last year</option>-->
                                <!--                        <option>last half year</option>-->
                                <!--                    </select>-->
                            </div>
                            <button class=\"update col-12\"> <i class=\"fas fa-sync-alt\"> </i> Update</button>
                        </div>
                    </div>";
            $code .= "
                    <div class=\"dropdown\">
                        <button onclick=\"dropdownFunction('filters')\" class=\"dropbtn\"><h5>Custom Filters <i class=\"fas fa-caret-down\"></i></h5> </button>
                        <div id=\"filters\" class=\"dropdown-content\">
                            <button class=\"add\" >
                            <i class=\"fas fa-plus\"></i>
                            </button>
                            <div class=\"custom-filter-group col-12\">
                                <label class=\"col-11\">Filter:</label>
                                <i class=\"fas fa-times delete col-1\"></i>
                                <div class=\"col-12\">
                                    <select class=\"col-12\">
                                        <option>Store Number</option>
                                        <option>Store</option>
                                        <option>Visit Date</option>
                                        <option>Activity</option>
                                    </select>
                                </div>
                                <div class=\"col-12\">
                                    <select class=\"col-12\">
                                        <option> contains </option>
                                        <option>does not contain</option>
                                        <option> starts with </option>
                                        <option>is equal to</option>
                                        <option> is greater than </option>
                                        <option> is less than </option>
                                        <option> is empty </option>
    
                                    </select>
                                </div>
                                <div class=\"col-12\">
                                    <input type=\"text\" list=\"value-list\" class=\"col-12\">
                                    <datalist id=\"value-list\">
                                        <option>Store Number</option>
                                        <option>Store</option>
                                        <option>Visit Date</option>
                                        <option>Activity</option>
                                    </datalist>
                                </div>
                            </div>
                 
                            <button class=\"update col-12\"> <i class=\"fas fa-sync-alt\"> </i> Update</button>
                        </div>
                    </div>";

            $code .= "
                </div>";

            return $code;
        }



        static function actions(){

            $code = "
                <div class=\"col-3 actions\">
                    <button class=\"share\">
                        <i class=\"fas fa-share-alt\"></i>
                    </button>
                    <button class=\"download\">
                        <i class=\"fas fa-file-download\"></i>
                    </button>
                    <button class=\"copy\">
                        <i class=\"fas fa-copy\"></i>
                    </button>
                </div>";

            return $code;

        }



        static function contentTable(){
            $code = "
            TABLE
            </div>
            ";
            return $code;
        }

        static function contentMatrix(){
            $code = "
            MATRIX
            </div>
            ";
            return $code;
        }

        static function contentGallery(){
            $code = "

                <div class='image-gallery'>";

            $code .= "
                    <div class=\"col-12 gallery-group\"> 
                        <h3>First Store</h3>";
            $code .= "
                        <div class=\"card col-4\">
                            <div class=\"image \" style=\"background-image: url(Images/img_10742_11_377_4.jpg)\">
                                <i class=\"fas fa-expand\"></i>
                            </div>
                            <div class=\"container\">
                                <h4><b>Title Example</b></h4>
                                <p class=\"text\">Text Example, very good Text!</p>
                                <p class=\"subtitle\">I am a Subtitle</p>
                            </div>
                        </div> ";

            $code .= "  
                        <div class=\"card col-4\">
                            <div class=\"image\" style=\"background-image: url(Images/img_10742_11_377_9.jpg)\">
                                <i class=\"fas fa-expand\"></i>
                            </div>
                            <div class=\"container\">
                                <h4><b>Title Example</b></h4>
                                <p class=\"text\">Text Example, very good Text!</p>
                                <p class=\"subtitle\">I am a Subtitle</p>
                            </div>
                        </div>";

            $code .= "  
                        <div class=\"card col-4\">
                            <div class=\"image \" style=\"background-image: url(Images/img_10742_11_377_11.jpg)\">
                                <i class=\"fas fa-expand\"></i>
                            </div>
                            <div class=\"container\">
                                <h4><b>Title Example</b></h4>
                                <p class=\"text\">Text Example, very good Text!</p>
                                <p class=\"subtitle\">I am a Subtitle</p>
                            </div>
                        </div>";

            $code .= "
                    </div>";
        
            $code .="   
                        <div class=\"col-12 gallery-group\">
        
                        <h3>Second Store</h3>";

            $code .="
                        <div class=\"card col-4\">
                            <div class=\"image \" style=\"background-image: url(Images/img_10265_31_205_3.jpg)\">
                                <i class=\"fas fa-expand\"></i>
                            </div>
                            <div class=\"container\">
                                <h4><b>Title Example</b></h4>
                                <p class=\"text\">Text Example, very good Text!</p>
                                <p class=\"subtitle\">I am a Subtitle</p>
                            </div>
                        </div>";

            $code .="        
                        <div class=\"card col-4\">
                            <div class=\"image \" style=\"background-image: url(Images/img_10306_31_136_4.jpg)\">
                                <i class=\"fas fa-expand\"></i>
                            </div>
                            <div class=\"container\">
                                <h4><b>Title Example</b></h4>
                                <p class=\"text\">Text Example, very good Text!</p>
                                <p class=\"subtitle\">I am a Subtitle</p>
                            </div>
                        </div>";

            $code .="
                    </div>
                </div>
            </div>";
            return $code;
        }



    }
