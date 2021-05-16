var win = $(window),
    nav_on = null;
$(function () {
    // 滑块控制
    (function() {
        var sup   = document.getElementById('subjects').getElementsByTagName('div')[0],
            items = sup.getElementsByTagName('a'),
            len   = items.length;

        win.on('load', function() {sup.className = "g-wrap ready state-0";})

        // 存储常用变量, 绑定事件
        for (var i=0,elem=null; i<len; i++) {
            elem = items[i];
            // styles.push(elem.style);
            // lefts.push(width_i*i);
            elem.setAttribute('idx', i+1);
            bind(elem, 'mouseover', hoverOn);
        }
        // 元素逐个出现
        initItems(0, len, 200);

        // 事件绑定函数
        bind(sup, 'mouseout', function() {
            // for (i=0; i<len; i++) {
            // styles[i].left = lefts[i] + 'px';
            // }
            sup.className = "g-wrap state-0";
        });

        // 控制元素逐个出现
        function initItems(idx, len, delay) {
            if (idx === len) return;
            // style = styles[idx];
            // style.left = lefts[idx] + "px";
            // style.opacity = "1";
            setTimeout(function() {initItems(idx+1, len, delay);}, delay);
        }

        // 函数绑定
        function bind (elem, evn, func) {
            if ('addEventListener' in elem) {
                bind = function (elem, evn, func) {elem.addEventListener(evn, func, false);}
            } else {
                bind = function(elem, evn, func) {elem['on'+evn] = func;}
            }
            bind(elem, evn, func);
        }

        //元素 mouseover 事件处理
        var i = 0, flag = false;
        function hoverOn() {
            sup.className = "g-wrap state-" + this.getAttribute('idx');
        }
    }());
});