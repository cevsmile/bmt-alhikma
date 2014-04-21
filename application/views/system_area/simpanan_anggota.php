
 <div id="cecep">
    <h2>Form Validation with CodeIgniter and jQuery</h2>
 
    <div class="field">
    <label for="name">Name</label>
    <input class="input" id="name" name="name" type="text" value="<?php echo set_value('name'); ?>" />
    </div>
 
    <div class="field">
    <label for="password">Password</label>
    <input class="input" id="password" name="password" type="password" value="<?php echo set_value('password'); ?>" />
    </div> 
 
    <div class="field">
    <label for="email">Email</label>
    <input class="input" id="email" name="email" type="text" value="<?php echo set_value('email'); ?>" />
    </div>    
 
    <div class="field">
    <label for="gender">Select Gender</label>
    <div class = "gender-fields">
    <input type="radio" class="radio" name="gender" value="male" <?php echo set_radio('gender', 'male'); ?>> Male
    <input type="radio" class="radio" name="gender" value="female" <?php echo set_radio('gender', 'female'); ?>> Female
    </div>
    </div> 
 
    <div class="field">
    <label for="state">Select State</label>
    <select class="state" name="state">
        <option class="droplist" ></option>
        <option class="droplist" value="Alabama" <?php echo set_select('state', 'Alabama'); ?> >Alabama</option>
        <option class="droplist" value="Alaska" <?php echo set_select('state', 'Alaska'); ?> >Alaska</option>
        <option class="droplist" value="Arizona" <?php echo set_select('state', 'Arizona'); ?> >Arizona</option>
    </select>
    </div>
 
    <div class="field">
    <label for="agree">Terms</label>
    <input type="checkbox" name="terms" class="checkbox" value="agree" <?php echo set_checkbox("terms","agree"); ?>/>
    </div>
 
</div>