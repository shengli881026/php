#### Git初始化设置

      git config --global user.name "xxx" 
      git config --global user.email "xxx@haozu.com"
      ssh-keygen -t rsa -C "xxx@haozu.com"
      cat ~/.ssh/id_rsa.pub 复制公钥到下面链接点击Add Key完成添加
   [添加公钥到gitlab](http://gitlab.corp.haozu.com/profile/keys "点击进入")
       
#### Git克隆项目 

      git clone git@gitlab.corp.haozu.com:rd/mob.git
  
#### git常用命令

      git add xxx 添加文件到暂存区
      git rm xxx 删除文件，替代物理删除文件，然后提交
      git commit -m "xxx" 提交更改到本地仓库
      git push 推送更改到远程分支
      git pull 从远程分支拉取更改
      git reset HEAD xxx 如果某个文件被add了，但不想commit可以恢复
      git branch xxx 创建某个分支
      git checkout xxx 切换到某个分支
      git checkout -b xxx 新建某个分支并切换过去
      git branch -av 查看所有本地分支+远程分支及对应版本号
      git merge --no-ff xxx 合并分支
      git branch -d/-D xxx 删除本地分支（区别是是否被merged）
      git diff xxx 查看文件改动
      git log xxx 查看文件变动日志


#### 好租助手下载地址
![image](http://fang-oss.haozu.com/cms/index/2017/09/15/GAM5j2MFEk.png)
