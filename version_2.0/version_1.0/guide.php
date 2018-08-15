<?php include "antet.php"; include "func.php";
$gen_stats=gen_stats(48);
?>
<html>
<?php echo "<link rel='stylesheet' type='text/css' href='".$imgs.$fimgs."default.css'>"; ?>

<head>
<title><?php echo $title; ?> - <?php echo $lang['home'] ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>

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
        <td align="left" class="td_content" align="left" style="text-align:left;">
Tebrikler!!! Yeni bir hesap açtın ve oyuna başlamak mı istiyorsun, burayı okuduğuna göre doğru yerdesin...ve hoşgeldin!!! :)</br></br>
şimdi öncelikle bi kabile oluşturman gerekiyo, büyük bir ülke oluşturabilmek için önce bir kabileden başlamalısın.</br>
Bunu yapmak için üst menüdeki "kabileler" seçeneğine tıkla, bu sayfada "yeni kabile oluştur" ve "başkenti değiştir" yazan 2 link göreceksin. Esasen bu sayfa sahip olduğun bütün kabileleri listelemek, aralarında geçişler yapmak, istediğini terkedip yeni kabile oluşturmak ve istediğini başkent olarak atamak amacıyla yapıldı. Fakat şuan hiç kabilen olmadığı için burası boş, "yeni kabile oluştur" linkine tıkla ve ilk kabileni oluştur. ılk oluşturduğun kabile otomatik olarak başkent olacaktır. şimdi tekrar üst menüye git ve oradaki başkent yazan seçeneği tıkla. ışte ilk şehrin karşında, hemen kötü düşünme şimdilik bomboş bi köy gibi görünebilir ama senin sayende büyük bir uygarlığın temeli olacaktır.  </br>
Kabilede hayat başladıktan sonra ilk yapman gereken ekonomiyi toplamak. Başlangıç olarak sana belli bir miktar kaynak sağladık ama unutma ki onlar su gibi akar gider, ilk kaynakları yine kaynak üretimi için harcamanı tavsiye ederiz. Bunun için kabilendeki ilk bina olan ana binayı tıkla. Seçtiğin hanedana bağlı olarak binaların isimleri değişebilir, o yüzden ana binayı en ortadaki bina olarak tarif edebiliriz.</br>
Burada inşa edebileceğin binaları göreceksin, Kaynaklar belirli binalarda üretilir. Tahıl üretmek için değirmen(erzak kontrol evi), odun için kereste fabrikası(ağaç kesiciler, kesim evi), taş için taş madeni(kaya ocakları,kaya kırıcılar) ve demir içinde dökümhane(demir evi, madenler) binalarını inşa etmen gerekir.Kolay gibi görünüyor öyle değilmi?</br>
Tamamda bu binaları inşası bittikten sonra üretim başlamadı ? Evet bu binalar doğrudan üretim yapmazlar, örneğin değirmen inşaası bittikten sonra değirmenin üstüne tıkla orada sahip olduğun çiftlikleri(tarla, buğday toplayıcı) göreceksin. Kabilenin yerine göre 4 veya 6 adet çiftliğin olabilir. Tahıl üretebilmek için bunları yükseltmen gerekir. Hepsini birden yükseltebileceğin gibi birini son seviyeye getirip daha sonra diğerinede geçebilirsin.</br></br>
Aynı şeyi diğer kaynaklar içinde yaparsan bütün kaynakların üretimini başlatmış olursun.</br>
şimdi büyük ihtimalle şu soruyu soruyorsun : "Altını nasıl üretirim?"</br>
şöyle açıklıym altın üretiimi sözkonusu değil, altını kabilenin halkından vergi olarak toplayabilirsin. Vergiyi ana binanda ayarlayabilirsin fakat şunu unutma vergi ne kadar çok olursa moral o kadar düşer, moralin düşmeside doğrudan üretimi etkiler.</br>
Moral kabile bakışında üretimlerin üstünde yazıyor. Gördünmü? şimdilik 100% yazıyordur. Bu demek oluyorki halkın morali tavan yapmış ve üretim kısmında yazan rakamların tamamını üretebiliyorlar.</br>
Eğer %50'lik bir vergi alırsan bu durumda moral %50'ye düşecektir ve üretimlerin doğrudan yarıya inecektir. Yani moral ve vergiler arasında ince bir ayar var, bunu güzelce tutturabilirsen ekonomini büyük bir hızla büyütebilirsin ve diğer kabileleri ele geçirebilirsin.</br>
</br></br>
Oyunun başlangıç kısmı şimdilik bu kadar. ınşallah oyundan zevk alırsınız. Eğer daha fazla sorunuz olursa akjmgalp ve metalsimyaci isimli oyunculara mesaj atabilirsiniz, forumumuz açıldığında oradada tartışmalarımız ve soru-cevaplarımız olacak tabi.</br> Tekrar hoşgeldin diyorum...ıyi Eğlenceler!!!</br>

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
