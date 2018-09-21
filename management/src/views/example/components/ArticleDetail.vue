<template>
  <div class="createPost-container">
    <el-form ref="postForm" :model="postForm" :rules="rules" class="form-container">
      <sticky :class-name="'sub-navbar '+postForm.status"  zIndex="5000">
        <el-button v-loading="loading" style="margin-left: 10px;" type="success" @click="submitForm">发布</el-button>
      </sticky>
      <div class="createPost-main-container">
        <el-row>
          <el-col :span="24">
            <el-form-item style="margin-bottom: 20px;" prop="title1">
              <MDinput v-model="form.title" :maxlength="100" name="name" required>
                活动名称
              </MDinput>
            </el-form-item>
            <el-form-item style="margin-bottom: 40px;" prop="title1">
              <MDinput v-model="form.location" :maxlength="100" name="name" required>
                活动地点
              </MDinput>
            </el-form-item>
            <el-form-item label-width="120px" label="人数:" class="postInfo-container-item">
              <el-slider v-model="form.peoplenum"  show-input min="1" max="1000"></el-slider>
            </el-form-item>
            <el-form-item label-width="120px" label="总时长:" class="postInfo-container-item">
              <el-slider v-model="form.alltime"  show-input min="1" max="1000"></el-slider>
            </el-form-item>
            <el-form-item label-width="120px" label="最多志愿时长:" class="postInfo-container-item">
              <el-slider v-model="form.volunteertimemax"  show-input min="1" max="100"></el-slider>
            </el-form-item>
            <el-form-item label-width="120px" label="最少志愿时长:" class="postInfo-container-item">
              <el-slider v-model="form.volunteertimemin"  show-input min="1" max="100"></el-slider>
            </el-form-item>
            <el-form-item label-width="120px" label="联系方式:" class="postInfo-container-item">
              <el-input v-model="form.contact" placeholder="鳄鱼" width='90px'></el-input>
            </el-form-item>
            <div class="postInfo-container">
              <el-row>
                <el-form-item label-width="120px" label="发布者:" class="postInfo-container-item">
                  <el-input v-model="form.hoster" placeholder=" " width='90px'></el-input>
                </el-form-item>
                <el-col :span="10">
                  <el-form-item label-width="80px" label="发布时间:" class="postInfo-container-item">
                    <el-date-picker v-model="form.starttime" type="datetime" format="yyyy-MM-dd HH:mm:ss" placeholder="选择日期时间"/>
                  </el-form-item>
                </el-col>
              </el-row>
            </div>
          </el-col>
        </el-row>
        <el-form-item style="margin-bottom: 40px;" label-width="120px" label="摘要:">
          <el-input :rows="1" v-model="form.summary" type="textarea" class="article-textarea" autosize placeholder="请输入内容"/>
        </el-form-item>
        <div class="editor-container">
          <Tinymce ref="editor" :height="400" v-model="form.detail" />
        </div>
      </div>
    </el-form>
  </div>
</template>

<script>
import Tinymce from '@/components/Tinymce'
import Upload from '@/components/Upload/singleImage3'
import MDinput from '@/components/MDinput'
import Sticky from '@/components/Sticky' // 粘性header组件
import { validateURL } from '@/utils/validate'
import { fetchArticle } from '@/api/article'
import { userSearch } from '@/api/remoteSearch'

const defaultForm = {
  status: 'draft',
  title: '', // 文章题目
  content: '', // 文章内容
  content_short: '', // 文章摘要
  source_uri: '', // 文章外链
  image_uri: '', // 文章图片
  display_time: undefined, // 前台展示时间
  id: undefined,
  platforms: ['a-platform'],
  comment_disabled: false,
  importance: 0
}

export default {
  name: 'ArticleDetail',
  components: { Tinymce, MDinput, Upload, Sticky,},
  props: {
    isEdit: {
      type: Boolean,
      default: false
    }
  },
  data() {
    const validateRequire = (rule, value, callback) => {
      if (value === '') {
        this.$message({
          message: rule.field + '为必传项',
          type: 'error'
        })
        callback(new Error(rule.field + '为必传项'))
      } else {
        callback()
      }
    }
    const validateSourceUri = (rule, value, callback) => {
      if (value) {
        if (validateURL(value)) {
          callback()
        } else {
          this.$message({
            message: '外链url填写不正确',
            type: 'error'
          })
          callback(new Error('外链url填写不正确'))
        }
      } else {
        callback()
      }
    }
    return {
      form:{
        peoplenum : 1,
        alltime: 1,
        volunteertimemax: 1,
        volunteertimemin: 1,
        contact: ' ',
        title: ' ',
        hoster: ' ',
        location:' ',
        starttime:'',
        summary:'',
        detail:'',
        type:'test',
        name:'name'
      },
      postForm: Object.assign({}, defaultForm),
      loading: false,
      userListOptions: [],
      rules: {
        image_uri: [{ validator: validateRequire }],
        title: [{ validator: validateRequire }],
        content: [{ validator: validateRequire }],
        source_uri: [{ validator: validateSourceUri, trigger: 'blur' }]
      }
    }
  },
  created() {
    if (this.isEdit) {
      const id = this.$route.params && this.$route.params.id
      this.fetchData(id)
    } else {
      this.postForm = Object.assign({}, defaultForm)
    }
  },
  methods: {
    fetchData(id) {
      fetchArticle(id).then(response => {
        this.postForm = response.data
        // Just for test
        this.postForm.title += `   Article Id:${this.postForm.id}`
        this.postForm.content_short += `   Article Id:${this.postForm.id}`
      }).catch(err => {
        console.log(err)
      })
    },
    submitForm() {
      this.form.starttime = Date.parse(this.form.starttime)/1e3
      this.axios.post('http://my.nuaa.edu.cn/xiaohongmao2/?service=App.Admin.AddActivity',this.form)
      .then(response => {
        if (response.data.ret==200) {
          this.loading = true
          this.$notify({
            title: '成功',
            message: '发布文章成功',
            type: 'success',
            duration: 2000
          })
        } else {
          this.$notify({
            title: '失败',
            message: response.data.msg,
            type: 'fail',
            duration: 2000
          })
        }
      })
    },
  }
}
</script>

<style rel="stylesheet/scss" lang="scss" scoped>
@import "src/styles/mixin.scss";
.createPost-container {
  position: relative;
  .createPost-main-container {
    padding: 40px 45px 20px 50px;
    .postInfo-container {
      position: relative;
      @include clearfix;
      margin-bottom: 10px;
      .postInfo-container-item {
        float: left;
      }
    }
    .editor-container {
      min-height: 500px;
      margin: 0 0 30px;
      .editor-upload-btn-container {
        text-align: right;
        margin-right: 10px;
        .editor-upload-btn {
          display: inline-block;
        }
      }
    }
  }
  .word-counter {
    width: 40px;
    position: absolute;
    right: -10px;
    top: 0px;
  }
}
</style>
