if ('addEventListener' in document) {
    document.addEventListener('DOMContentLoaded', function() {
        FastClick.attach(document.body);
    }, false);
}

var method = {
    /**
     * 重置输入框样式
     * @param elem
     * @returns {boolean}
     */
    resetStyle: function(elem) {
        if (typeof elem == "string") {
            if (elem.indexOf(" ") == -1) {
                elem = [elem]
            } else {
                elem = elem.split(" ")
            }
            $.each(elem, function(i, cont) {
                $("#" + cont).next().hide().parent().removeClass("input_err")
            })
        } else {
            return false
        }
    },
    /**
     * 输入框被选中后去掉报错提示
     * @param elem
     * @returns {boolean}
     */
    focusReset: function (elem) {
        if (typeof elem == "string") {
            if (elem.indexOf(" ") == -1) {
                elem = [elem]
            } else {
                elem = elem.split(" ")
            }
            $.each(elem, function(i, cont) {
                var $this = $("#" + cont);
                $this.on("focus", function() {
                    $this.next().hide().parent().removeClass("input_err")
                });
            })
        } else {
            return false
        }
    },
    /**
     * 检验电话号码
     * @param phone
     * @returns {boolean}
     */
    checkPhone: function(phone) {
        if (phone == '' || phone == null) {
            return false
        }
        var patrn = /^1[3|4|5|7|8][0-9](\d{8})$/;
        if (!(patrn.test(phone))) {
            return false
        } else {
            return true
        }
    },
    /**
     * 身份证验证
     * @param IdCard：身份证号
     * @returns {boolean}
     */
    checkIdCard: function (IdCard) {
        var iW,iSum,iC,iVal,iJYM,sJYM;
        var reg = /^\d{15}(\d{2}[0-9X])?$/i;
        if (!reg.test(IdCard)) {
            return false;
        }

        if (IdCard.length == 15) {
            var n = new Date();
            var y = n.getFullYear();
            if (parseInt("19" + IdCard.substr(6, 2)) < 1900 || parseInt("19" + IdCard.substr(6, 2)) > y) {
                return false;
            }

            var birth = "19" + IdCard.substr(6, 2) + "-" + IdCard.substr(8, 2) + "-" + IdCard.substr(10, 2);
            if (!this.IsDate(birth)) {
                return false;
            }
        }
        if (IdCard.length == 18) {
            var n = new Date();
            var y = n.getFullYear();
            if (parseInt(IdCard.substr(6, 4)) < 1900 || parseInt(IdCard.substr(6, 4)) > y) {
                return false;
            }

            var birth = IdCard.substr(6, 4) + "-" + IdCard.substr(10, 2) + "-" + IdCard.substr(12, 2);
            if (!this.IsDate(birth)) {
                return false;
            }

            iW = new Array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2, 1);

            iSum = 0;
            for (var i = 0; i < 17; i++) {
                iC = IdCard.charAt(i);
                iVal = parseInt(iC);
                iSum += iVal * iW[i];
            }

            iJYM = iSum % 11;
            if (iJYM == 0) sJYM = "1";
            else if (iJYM == 1) sJYM = "0";
            else if (iJYM == 2) sJYM = "x";
            else if (iJYM == 3) sJYM = "9";
            else if (iJYM == 4) sJYM = "8";
            else if (iJYM == 5) sJYM = "7";
            else if (iJYM == 6) sJYM = "6";
            else if (iJYM == 7) sJYM = "5";
            else if (iJYM == 8) sJYM = "4";
            else if (iJYM == 9) sJYM = "3";
            else if (iJYM == 10) sJYM = "2";

            var cCheck = IdCard.charAt(17).toLowerCase();
            if (cCheck != sJYM) {
                return false;
            }
        }
        return true;
    },
    /**
     * 身份证生日
     * @param strDate
     * @returns {boolean}
     * @constructor
     */
    IsDate: function (strDate) {
        var strSeparator = "-"; //日期分隔符
        var strDateArray;
        var intYear;
        var intMonth;
        var intDay;
        var boolLeapYear;
        strDateArray = strDate.split(strSeparator);
        if (strDateArray.length != 3) return false;
        intYear = parseInt(strDateArray[0], 10);
        intMonth = parseInt(strDateArray[1], 10);
        intDay = parseInt(strDateArray[2], 10);
        if (isNaN(intYear) || isNaN(intMonth) || isNaN(intDay)) return false;
        if (intMonth > 12 || intMonth < 1) return false;
        if ((intMonth == 1 || intMonth == 3 || intMonth == 5 || intMonth == 7 || intMonth == 8 || intMonth == 10 || intMonth == 12) && (intDay > 31 || intDay < 1)) return false;
        if ((intMonth == 4 || intMonth == 6 || intMonth == 9 || intMonth == 11) && (intDay > 30 || intDay < 1)) return false;
        if (intMonth == 2) {
            if (intDay < 1) return false;
            boolLeapYear = false;
            if ((intYear % 100) == 0) {
                if ((intYear % 400) == 0) boolLeapYear = true;
            }
            else {
                if ((intYear % 4) == 0) boolLeapYear = true;
            }
            if (boolLeapYear) {
                if (intDay > 29) return false;
            }
            else {
                if (intDay > 28) return false;
            }
        }
        return true;
    },
    /**
     * 检查必填项的值是否为空
     * @param val
     * @returns {boolean}
     */
    check_value: function (val) {
        if (val.length == "0" || val == "0") {
            return false
        } else {
            return true
        }
    },
    /**
     * 报错提示
     * @param elem
     */
    error_tips: function (elem) {
        var _val = elem.val();
        if (_val == "0" || _val.length == "0") {
            elem.addClass("red").parent().addClass("input_err")
        }
    },
    /**
     * 重置下拉选择器
     * @param elem
     */
    resetSelect: function (elem) {
        if (elem.hasClass("col-2")) {
            elem.on("change", function() {
                $(this).removeClass("red");
                if (!elem.siblings("select").hasClass("red")) {
                    $(this).parent().removeClass("input_err")
                }
            })
        } else {
            elem.on("change", function() {
                $(this).removeClass("red").parent().removeClass("input_err")
            })
        }
    },
    /**
     * 手动触发预渲染操作
     * @param rel:那种类型 url:预渲染的页面或资源
     * rel='prerender' 表示浏览器会帮我们渲染但隐藏指定的页面，一旦我们访问这个页面，则秒开了！
     * rel='prefetch' 表示当 rel='subresource' 所有资源都加载完后，开始预加载这里指定的资源，有最低的优先级。
     */
    link: function(rel,url){
        var hint =document.createElement("link");
        hint.setAttribute("rel",rel);
        hint.setAttribute("href",url);
        document.getElementsByTagName("head")[0].appendChild(hint);
    },
    /**
     * tab切换
     * @param cfg
     * @returns {*}
     */
    tab:function(cfg){
        var options = {
            tab: "#navTab",
            cntSelect : "#activityWrap",
            tabEvent : "click",
            onStyle : "active",
            menuChildSel : "*",
            cntChildSel : "*",
            callback:null,
            handler:null
        };
        if(typeof cfg === "undefined") cfg={};
        var CFG = $.extend(options,cfg);
        var tabList = $(CFG.tab);
        tabList.each(function(i){
            var _this=$(this);
            var $menus=_this.children( CFG.menuChildSel );
            var $container=$( CFG.cntSelect ).eq(i);

            if( !$container) return;

            $menus.on(CFG.tabEvent,function(){
                var _this = $(this),
                    index=$menus.index( _this ),
                    $context = $container.children( CFG.cntChildSel ).eq( index );
                _this.addClass( CFG.onStyle ).siblings().removeClass( CFG.onStyle );
                $context.removeClass( "hide").siblings().addClass( "hide" );
                CFG.handler(_this,$context);
                return false;
            });
            //$menus.eq(0)[ CFG.tabEvent ]();
        });
    },
    getCode: function(cfg){
        var options = {
            actionBtn: "#getCode",
            phoneElem: "#joinPhone", //固定不变或者没有的话 写空
			signup_id: "signup_id",
            disabledCLass: "disabled",
            url: '/indexs/sendMsg/'
        };
        var CFG = $.extend(options,cfg);
        var $getCode = $(CFG.actionBtn),
            $joinPhone = CFG.phoneElem.indexOf("#")>=0?$(CFG.phoneElem):$("[name='"+CFG.phoneElem+"']");
			$signupId = CFG.signup_id.indexOf("#")>=0?$(CFG.signup_id):$("[name='"+CFG.signup_id+"']");
        var _click = true;
        $getCode.on('click', function () {
            if (_click == "false" || $getCode.hasClass(CFG.disabledCLass)) {
                return false
            }
            var _phoneCheck = method.checkPhone($joinPhone.val()),
				_signup_id = $signupId.val(),
                _phoneNum = 0;
            if(!_phoneCheck){
                $.dialog({
                    title:"提示信息",
                    content : "请输入正确的手机号！",
                    ok: function(){
                        $joinPhone.focus();
                    }
                });
                return false;
            }else{
                _phoneNum = $joinPhone.val();
            }

            var t = new Date();
            //remain time
            var time = 60,
                timeDefText = $getCode.text();
            var freshTime = function () {
                var timeText = time + '秒';
                $getCode.text(timeText);
                if (time < 1) {
                    _click = true;
                    clearInterval(sh);
                    $getCode.text(timeDefText);
                    $getCode.removeClass(CFG.disabledCLass);
                }
                time--;
            };
            freshTime();
            $getCode.addClass(CFG.disabledCLass);
            var sh = setInterval(freshTime, 1000);

            $.ajax({
                type: 'POST',
                url: CFG.url,
                data: {
                    tel:_phoneNum,
					signup_id: _signup_id,
                    t:t.getTime()
                },
                dataType: 'json',
                success: function (result) {
                    if (result.status === 'true') {
                        ;
                    } else if (result.status === 'false') {
                        $.dialog({
                            content: result.content,
                            title: "提示信息",
                            ok: function(){}
                        });
                        return false;
                    }
                }
            });
            return false;
        });
    }
};