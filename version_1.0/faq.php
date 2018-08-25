<?php include "antet.php"; include "func.php";
$gen_stats=gen_stats(48);
?>
<html>
<?php echo "<link rel='stylesheet' type='text/css' href='".$imgs.$fimgs."default.css'>"; ?>

<head>
<title><?php echo $title; ?> - <?php echo $lang['home'] ?></title>
</head>

<body class="q_body">

<div align="center">
<?php echo $top_ad; ?>
    <table class="q_table">
      <tr>
        <td class="td_logo"><?php logo($title); ?></td>
      </tr>
      <tr>
        <td class="td_top_menu">
	<?php menu_up(); ?>
	</td>
      </tr>
      <tr>
        <td class="td_content">
1. How do I create a town?</br>
A: Go to the "towns" link in the upper menu; then you will see "create capital" if you do not have one yet, or "create new town" is you already have a capital.
</br></br>
2. Why can't I create a new town?</br>
A: Well, there are 2 possible reasons: you do not have a level 10 main building in your capital city or you do not have at least 10 colonists in your capital city.
</br></br>
3. Why isn't my town producing any resources?</br>
A: You need to construct the economy buildings first, then upgrade them. Be careful, at first you will need a good stock of crop, for each time you build/upgrade something the population increases, and with it, so does the upkeep. In plain terms, the more you build/upgrade, the lesser crop your town will produce. So be sure to keep a good look at the crop production indicator so that it doesn't reach negative values.
</br></br>
4. What does purge mean?</br>
A: You can purge(destroy) your colonies, but not your capital.
</br></br>
5. What happens when I abandon a town?</br>
A: It becomes marked as abandoned, and any user can aquire it as his own.
</br></br>
6. What faction should I choose?</br>
A: the Empire is the balanced faction, while the Guild is oriented towards economy and the Order towards warfare. Each has it's advantages and disadvantages, which makes them quite balanced in the overall picture. Choose the one most suitable to your character.
</br></br>
7. How can I attack another town?</br>
A: First of all you need to forge weapons for your future troops(construct the proper building), then you can research new troops(their HP, attack & defense) and finally train them. You can attack another town from the "dispatch" page; you will see in the center of your town a small crossroad sign. Click it to go to the dispatch page.
Here you can also simulate infinite combat situations using the combat simulator, and you can promote an existing unit to the rank of general.
</br></br>
8. What does the general do?</br>
A: He is the elite unit of your army. You can send him along with an army when attacking/raiding/spying a town. If there was a victorious attack, he will gain a level and increase in his skills. You can always promote another unit to the rank of general, but it will start from level 1.
</br></br>
9. How can I produce gold?</br>
A: Gold is obtained from taxes. You can set a tax rate for your population at the main building of a maximum value of 210. Beware, for the morale of the people is affected by taxes.
</br></br>
10. What is "morale"?</br>
A: Morale is a percentage number that represents the actual resource production. Meaning that for a morale of 90%, for example, your town will produce only 90% of the shown resource production rates.
A morale of 100% will ensure that no resources are lost.
You can boost the morale of the population by building a cathedral and upgrading it.
</br></br>
11. How can I create or join an alliance?</br>
A: To create an alliance, you first need to build the embassy (or whatever name the designated building may have for your faction; read carefully in the main building constructions options and you will see a short description for all buildings).
To join an alliance you need to have an invitation. To get one, try contacting the alliance founder.
</br></br>
12. How can I rename a town?</br>
A: In the town view page [the one with all the buildings...], you will see a signpost at the bottom; click it and you will be taken to the town rename and description edit page.
</br></br>
13. How can I change my password?</br>
A: In the upper menu you have "profile"; click it and you will be taken to the profile page. There you can edit you profile's description, you can designate a sitter, change the graphic pack path, change your password or have your account queued for deletion.
</br></br>
14. What is a "sitter"?</br>
A: A sitter is a player who looks after your towns when you cannot login and look after them yourself. An account "sitter".
You can change your account sitter in the "profile" page.
Remember that a sitter cannot change your password or do any actions that require your password.
</br></br>
15. I cannot join an alliance. I get the message to quit my current alliance. What do I do?</br>
A: You need to build an embassy and quit your current alliance in order to join another.
</br></br>
16. How do I create an army?</br>
First you need the required buildings: academy(for HP(hit points) upgrades), blacksmith(for ATK(attack) and DEF(defense) upgrades), barracks(this is where the troop training takes place), weapon & armor shop(for forging weapons), weapon warehouse(for storing required weapons), stable(for breeding horses required for mounted troops), port(for building vessels).
Before you can train a type of troops, you need to make sure that they are at least level 1 in HP, ATK and DEF and that you have enough required weapons in your weapon warehouse(see troop description for required weapons).
You can then train troops at the barracks.
</br></br>
17. How do I create a new map?</br>
You create a map in an image editor like Paint. The data is decoded by the program [map_extractor.exe] using color coded information.
A map has 3 types of terrain:
0x: water [where x is the id of the body of water; 2 bodies of water are not suppose to be in direct contact with each other];
1x: land where towns can be built [x marks the id of the displayed image; if x=0, the install.php will pick a random terrain image];
2x: mountains; here towns cannot be built [x marks the id of the displayed image; if x=0, the install.php will pick a random terrain image];
The color codes:
a sector of water will be a pixel with the RGB code of: x 0 255;
a sector of land will be a pixel with the RGB code of: x 255 0;
a sector of mountains will be a pixel with the RGB code of: 255 x 0
</br></br>
18. How can I conquer a town?</br>
In order to do that, you need to attack that town, win the battle and have, at the end of the battle, at least 100 colonists remaining.
	</td>
      </tr>
      <tr>
        <td class="td_bottom_menu">
        <?php menu_down(); ?>
        </td>
      </tr>
    </table>
<?php echo $bottom_ad; ?>
<p><?php about(); ?></div>

</body>

</html>
