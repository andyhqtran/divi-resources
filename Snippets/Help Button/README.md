# Help Button
![Help Button](Help%20Button.jpg)
A floating help button in the bottom right corner.

## How to Install Help Button
1. Create a new page.
2. Create a row.
3. Create a code module.
4. Copy and paste the code below.

```html
<!-- Styles -->
<style>
.at-help-btn {
  z-index: 100;
  position: fixed;
  right: 10px;
  bottom: 20px;
  display: -webkit-inline-box;
  display: -webkit-inline-flex;
  display: -ms-inline-flexbox;
  display: inline-flex;
  -webkit-box-align: center;
  -webkit-align-items: center;
      -ms-flex-align: center;
          align-items: center;
  -webkit-box-orient: horizontal;
  -webkit-box-direction: normal;
  -webkit-flex-direction: row;
      -ms-flex-direction: row;
          flex-direction: row;
  background: #999999;
  padding: 9px;
  border-radius: 100px;
  color: #FFF;
  font-size: 1.125rem;
  text-decoration: none;
  -webkit-transition: 0.3s ease;
  transition: 0.3s ease;
}
.at-help-btn:hover {
  background: #4C4C4C;
}
.at-help-btn__icon {
  border-radius: 100%;
  width: 32px;
  height: 32px;
  padding: 2px;
}
.at-help-btn__icon img {
  display: block;
  width: 100%;
}
.at-help-btn__text {
  display: none;
}
.at-help-btn__text span {
  padding: 0 15px 0 10px;
}
</style>

<!-- Help Button -->
<a href="#" class="at-help-btn">
  <!-- Help Icon -->
  <div class="at-help-btn__icon">
    <svg width="28" height="28" viewBox="0 0 28 28" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
      <image x="9" y="9" width="32" height="32" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAABGdBTUEAA1teXP8meAAABN1JREFUaAXtmUuMVEUUhnsQGAEVwiBkUGPc6MqAD5SlwTVGo4HExA2BuNGdBuLKGBS3EkbAmLjTGBfGOOJGjTHu1BiIUfFFfBBjABegDJBA+/1jd3Pmv1X30d2DC/sk/9w6p/5z6lTd6qq6Na3WSEYj8P8egbFhdL/dbi8gzj1gE7gb3AomwbVAcgb8Do6Cz8FH4LOxsbFLPP87IfGbwIvgOGgqv+KwB9xwxXtAo6vAQXABDCrnCbAfTFyRjtDQo+AUGLacJODWeesEwReBV0qyPk3d62A72AAmwOIO9MZk2wHeAGdATl6mYuFQO0LApeBQpsXvsG8DS+o2Clfx1NHvQUqmMdaOV9ougTTy7ydaOYvtKdD3aOGr2DvBDHB5F0PfsXudIkhq2mjkbu+RBiwQax34EbhMDRSaaPrBunyJYXUuMHV3gANAU0srjHAUaKVZV+K3hvrDwGVLzqfUTpTrga82Gvlk8tiXgFdBmVyiUp27OtU4dnXC38QJbCtT/FIbTgdBFM355LTBruQ/ieSK8sfU5zqxnrpz5r+vNFmvxFk77AUL8rTzujq8qpG3ULPq/q6/P6ndZQ7q0FrnZXXIOh5E0XxOrgjYNeddvsawGWi5XAYeAN+CKJpOyd8Edq1OP0Qy5eezCccKiAvAcXPeFjmxDO+AcZX88shRGdsK4J3IrjJwd4Aov6BUHz4hbYxelLXDZjcV6vR2omz25Ls6pAcjkfI33Tp/Uqc395fxNzhPx2AXHYmjTHPsnYkGK99s+oemR/WDqFC+xfSeSpt/o7zXM/xbuN/0VqoDOs9H0dk9KzQ0DqKczZJbraus7qLprnrbdzkh1QF9jEQ5HJUByw+Zf1Vsr7/N/Isqc843r6Gc04mr9f1Pm9OPFTO4bIG72vgnLtdmSjj4+r84Q61tJuYjwI/Qb2MrXVWoHwdRzlc2CnuoHSDe7phBp3yIZ3Zl6yYJp68O+BRa1Q3Y9EkCz3YSjo/XUJKboseH19cU+iq2Rrmw9npDKR0/7dAXLdZUipuz4et70hHnplYhXX1EWR+VBuUn4Mb4n6I/2cBfVD9qeG5zGujG1r1NlE1RaVC+z7jPsVk0vQfyjctzsyZQeW332mvX6rG0yCy34KMPmSjLyj3m1uJ4DfCjhG+yc52k4aTD3G8gyvYic34tNP54TIDyz6B02e1lBHGPOetLbFGPMM8F2tJ1zE+Ww+7azeJ4I/ApsLN2AIjWeLuh7zPmfw59skkMJaCP8CgzKL4qZGNGR5WzRKuAeidQwlH2Gq1axXsC6Lovij6411R79/cGiD0JjoEof6CsqNNmgYPj1hipU9bVR2Un3K8Q3AzwlfwR90N/2KjNVAL4VFIbehP9bnCFBIilaXMMuDSfOh6diAvBtEdG129iF+h7dcJXq41+sD7nMbXfAf4B5OnV0wmke59UJzDP3h7oA7z2RgVXm5TWeV8qMc2Kkq88rdbLvsMioN7E1Gz49B/t2G8CJbYR6CQ53oHKsqnuLeA7LKae7KU0nJFP9ZDgW4Cu+4YtWm0G+8GmEk7ZaGgl2AdScxdzI1GMl0B/S2Uqwbo2Gl0LXgC6dGoqOtvoa63ZDmvJ1TscmZOrJKFzv648dPzVU7cHSuw6IDkN4r9ZdXf0Bcfr2ju0goxkNAKjESiOwD8N88OiY3W3TgAAAABJRU5ErkJggg==" transform="translate(-11 -11)" fill="none" fill-rule="evenodd"></image>
    </svg>
  </div>

  <!-- Help Text -->
  <div class="at-help-btn__text">
    <span>Help</span>
  </div>
</a>

<!-- Scripts -->
<script>
  jQuery(document).ready(function($) {
    $('.at-help-btn').hover(function() {
      $(this).children('.at-help-btn__text').animate({
        width: 'toggle',
        opacity: 'toggle',
      }, 300);
    });
  });
</script>
```

## Credits
- [Mario Maruffi](https://dribbble.com/MarioMaruffi)
- [Andy Tran](http://codepen.io/andytran/)

-
Created by [Andy Tran](http://andytran.me) on Apr. 28th, 2016.
