define(function(require,exports,module){
    jQuery.validator.addMethod("emailaddress",function(value, element) {
//		var email = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/;
        var email = /^\s*\w+(?:\.{0,1}[\w-]+)*@[a-zA-Z0-9]+(?:[-.][a-zA-Z0-9]+)*\.[a-zA-Z]+\s*$/;
        return this.optional(element) || (email.test(value));
    }, "请正确填写邮箱地址");
    jQuery.validator.addMethod("uname", function(value, element) {
        var name = /^[\u4e00-\u9fa5]+$/;
        return this.optional(element) || (name.test(value));
    }, "请输入中文");
    //密码
    jQuery.validator.addMethod("regexPassword", function(value, element) {
        return this.optional(element) || /^(?![^a-zA-Z]+$)(?!\D+$).{6,12}$/.test(value);
    }, "密码为6-12位字符<span class='spsp'>（格式为字母加数字）</span>");
    //手机
    jQuery.validator.addMethod("mobilePhone", function(value, element) {
        return this.optional(element) || /^1[53874]\d{9}$/.test(value);
    }, "请输入<span class='spsp'>11</span>位手机号码");
    //邮箱或手机
    jQuery.validator.addMethod("emailorphone",function(value,element){
        return this.optional(element) || /^\s*\w+(?:\.{0,1}[\w-]+)*@[a-zA-Z0-9]+(?:[-.][a-zA-Z0-9]+)*\.[a-zA-Z]+\s*$/.test(value) || /^1[53874]\d{9}$/.test(value) ;
    },"手机或邮箱格式错误");
    jQuery.validator.addMethod("qqEmail",function(value, element) {
        var email = /^([0-9_-])+@qq.com$/;
        return this.optional(element) || (email.test(value));
    }, "QQ邮箱格式不正确");
    jQuery.validator.addMethod("commonEmail",function(value, element) {
        var oldEmail = $.trim($("#userEmail").val());
        if(oldEmail === value){
            return false;
        }
        return true;
    }, "新邮箱与当前邮箱不能相同");
    jQuery.validator.addMethod("nickNameRegex",function(value,element){
        return this.optional(element) || (/^[a-zA-Z0-9\u4e00-\u9fa5]{3,12}$/.test(value));
    },"昵称格式错误<span class='spsp'>（不能包含特殊字符）</span>");
    jQuery.validator.addMethod("accountName",function(value,element){
        return this.optional(element) || /^\s*\w+(?:\.{0,1}[\w-]+)*@[a-zA-Z0-9]+(?:[-.][a-zA-Z0-9]+)*\.[a-zA-Z]+\s*$/.test(value) || /^[a-zA-Z0-9\u4e00-\u9fa5]{3,12}$/.test(value) ;
    },"用户名格式错误（邮箱或昵称）");
});