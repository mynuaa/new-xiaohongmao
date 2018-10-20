<template>
  <div class="app-container">
    <el-table :key="tableKey" :data="list" border fit highlight-current-row >
      <el-table-column label="序号" align="center" width="70">
        <template slot-scope="scope">
          <span>{{ scope.row.aid }}</span>
        </template>
      </el-table-column>
      <el-table-column label="时间" width="100px" align="center">
        <template slot-scope="scope">
          <span>{{ scope.row.starttime | parseTime('{y}-{m}-{d}') }}</span>
        </template>
      </el-table-column>
      <el-table-column label="活动名称"  width="180px" min-width="100px">
        <template slot-scope="scope">
          <span class="link-type" @click="showArticle(scope.row.aid)">{{ scope.row.title }}</span>
        </template>
      </el-table-column>
      <el-table-column label="主办方" width="100px" align="center">
        <template slot-scope="scope">
          <span>{{ scope.row.hostname }}</span>
        </template>
      </el-table-column>
      <el-table-column label="活动人数" align="center" width="75">
        <template slot-scope="scope">
          <span>{{ scope.row.peoplenum }}</span>
        </template>
      </el-table-column>
      <el-table-column label="活动时长" align="center" width="75">
        <template slot-scope="scope">
          <span>{{ scope.row.volunteertimemin }}</span>
        </template>
      </el-table-column>
      <el-table-column label="活动状态" class-name="status-col" width="100">
        <template slot-scope="scope">
          <el-tag :type="scope.row.status">{{ scope.row.status }}</el-tag>
        </template>
      </el-table-column>
      <el-table-column label="操作" align="center" width="400" class-name="small-padding fixed-width">
        <template slot-scope="scope">
          <el-button type="success" size="primary" @click="showArticle(scope.row.aid)">查看活动
          </el-button>
          <router-link :to="'/up/'+scope.row.aid" v-permission="['admin']">
            <el-button size="primary">上传时长<i class="el-icon-upload el-icon--right"></i></el-button>
          </router-link>
          <router-link :to="'/example/edit/'+scope.row.aid" class="link-type" v-permission="['admin']">
            <el-button type="primary" size="primary" icon="el-icon-edit">修改文章</el-button>
          </router-link>
        </template>
      </el-table-column>
    </el-table>

    <div class="footer">
      <el-pagination
        background
        layout="prev, pager, next"
        :total="total"
        :page-size="20"
        @current-change="currentpage">
      </el-pagination>
    </div>  
    <el-dialog title="活动详情" :visible.sync="dialogFormVisible">
      <div class="activity">
        <label>活动名称：</label><span>{{temp.title}}</span>
      </div>
      <div class="activity">
        <label>活动地点：</label><span class="content">{{temp.location}}</span>
      </div>
      <div class="activity">
        <label>主办方：</label><span class="content">{{temp.hostname}}</span>
      </div>
      <div class="activity">
        <label>活动时长：</label><span class="content">{{temp.volunteertimemin}} 小时</span>
      </div>
      <div class="activity" v-permission="['admin']">
        <el-table
          :data="joindata"
          style="width: 100%">
          <el-table-column
            prop="stuid"
            label="已认证">
        </el-table-column>
        <el-table-column
          prop="timelong"
          label="时长">
        </el-table-column>
         </el-table>
        <el-table
          :data="notcertified"
          style="width: 100%">
        <el-table-column
          prop="stuid"
          label="未认证">
        </el-table-column>
        <el-table-column
          prop="timelong"
          label="时长">
        </el-table-column>
        </el-table>
      </div>
      <div class="activity">
        <label>活动内容：</label><span v-html="temp.detail"></span>
      </div>
    </el-dialog>
  </div>
</template>

<script>
import { parseTime } from '@/utils'
import {getToken} from '@/utils/auth'
import permission from '@/directive/permission/index.js'
import checkPermission from '@/utils/permission'
export default {
  directives: { permission },
  data() {
    return {
      tableKey: 0,
      list: null,
      listLoading: true,
      listQuery: {
        page: 1,
        limit: 20,
        importance: undefined,
        title: undefined,
        type: undefined,
        sort: '+id'
      },
      temp:[],  
      joindata:[],
      notcertified:[],
      dialogFormVisible: false,
      total:1
    }
  },
  created() {
    this.getList()
    this.getallnum()
  },
  methods: {
    checkPermission,
    getList(from = 0) {
      let jwt = getToken()
      this.axios.post('http://my.nuaa.edu.cn/xiaohongmao2/?service=App.Admin.AllActivity',{
        from:from,
        'jwt':jwt
      })
      .then((response) => {
          this.list = response.data.data
          for(var prop in response.data.data){
             if(response.data.data[prop].status==1){
               this.list[prop].status = "进行中"
             }
             if(response.data.data[prop].status>1e9){
               this.list[prop].status = "审核中"
             }
             if(response.data.data[prop].status==2){
               this.list[prop].status = "审核关闭"
             }
          }
        })
    },
    getallnum(){
      this.axios.post("http://my.nuaa.edu.cn/xiaohongmao2/?service=App.Front.ShowData",)
      .then((response)=>{
        this.total = response.data.data.actNum
      })
    },
    showArticle(row){
      this.dialogFormVisible = true
      let jwt = getToken()
      this.axios.post('http://my.nuaa.edu.cn/xiaohongmao2/?service=App.Admin.GetActivity',{
        'aid':row,
        'jwt': jwt
      })
      .then((response) => {
          this.temp = response.data.data.activity
          for(var prop of response.data.data.join){
            if(response.data.data.join[prop]==1){
              this.notcertified.push(response.data.data.join[prop])
            }
            if(response.data.data.join[prop]>10e9){
              this.joindata.push(response.data.data.join[prop])
            }
          }  
        })
      this.$nextTick(() => { 
        this.$refs['dataForm'].clearValidate()
      })
    },
    currentpage(id){
      this.getList((id-1)*20)
    }
  }
}
</script>
<style>
.name{
  display: inline-block;
}
.activity{
  padding-top: 30px;
}
.content{
  padding-left:20px;
}
.footer{
  padding-top:20px;
}
</style>