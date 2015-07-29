# Pancake Plugin: Display Project Name
A simple plugin for [Panecake App](https://www.pancakeapp.com/ref/qetTcQ) to enable the display of the project name on invoices.

## Instructions

#### Step 1. Install the plugin
Copy the `DisplayProjectName` folder to the plugins directory like so:

`~/third_party/modules/DisplayProjectName`

#### Step 2. Create a new theme
I found it easier to modify an existing theme. You can choose to modify the original theme, although this would mean the file may be overwritten in future Pancake updates.

As an example, I used the pancake theme (`~/third_party/themes/pancake`) and copied it to a new folder (`~/third_party/themes/pancakeplus`).

Be sure to update the `info.php` file of your new theme so that the names don't clash. Following my exmaple, I only changed the theme name to 'Pancake Plus Theme'.

#### Step 4. Insert the code into your invoice display.
The code to display the project name is `<?php echo Plugin_Displayprojectname::get_project_name_by_id($project_id); ?>`

In my theme, I chose to display the project name inside the client details section, like this:

Invoice display file: `~/third_party/themes/pancakeplus/views/layouts/detailed.php`

```php
[...]
<div id="clientInfo">
    <div id="billing-info">
      <table cellspacing="0" cellpadding="0" id="billing-table">
        <tr>
          <td style="width: 240px; vertical-align:top;">
            <h2><?php echo $invoice['company'];?></h2>
            <?php //Display Project Name
            if ($project_name = Plugin_Displayprojectname::get_project_name_by_id($invoice['project_id'])): ?>
              <p class="invoiceid">
                <i><?php echo 'Project: ' . $project_name; ?></i>
              </p>
            <?php endif;
            //End Project Name Display ?>
            <p><?php echo escape($invoice['first_name'].' '.$invoice['last_name']);?><br />
            <?php echo escape(nl2br($invoice['address']));?></p>
          </td>
          <td style="width: <?php echo (!$pdf_mode)? "560px" : "300px" ?>; vertical-align:top;">
      			<?php if ( ! empty($invoice['description'])): ?>
      			<h3><?php echo __('global:description');?>:</h3>
      			<?php echo escape(auto_typography($invoice['description']));?>
      			<?php endif; ?>
      		</td>
        </tr>
      </table>
      <br /> <br />
    </div>
</div><!-- /clientInfo -->
[...]
```
