import AdminContent from './MainAdmin'
import AdminAuth from './views/MainAuth'

//main continer frontend
import FrontEnd from './FrontEnd'

import Home from './views/Home'
import Profile from './views/front/Profil'
import Information from './views/front/Information'
import Download from './views/front/Download'
import ContactUs from './views/ContactUs'
import DetailInformation from './views/front/DetailInformation'
import Home2 from './views/Home2'

//end frontend

//main container backend
import BackEnd from './BackEnd'

//auth
import Login from './views/Login'
import User from './views/Users'
import IndexUser from './views/users/index'
import CreateUser from './views/users/create'
import EditUser from './views/users/edit'
import ChangePassword from './views/users/ChangePassword'

//level
import UserLevel from './views/UserLevel'
import IndexUserLevel from './views/userlevels/index'
import CreateUserLevel from './views/userlevels/create'
import EditUserLevel from './views/userlevels/edit'

//dashboard
import Dashboard from './views/Dasboard'

//position or jabatan
import Position from './views/Position'
import IndexPosition from './views/positions/index'
import CreatePosition from './views/positions/create'
import EditPosition from './views/positions/edit'


//kontingen
import Contingent from './views/Contingent'
import IndexContingent from './views/contingents/index'
import CreateContingent from './views/contingents/create'
import EditContingent from './views/contingents/edit'

import Participant from './views/Participant'
import IndexParticipant from './views/participants/index'
import CreateParticipant from './views/participants/create'
import EditParticipant from './views/participants/edit'
import MainAuth from "./MainAuth";

//information
import InformationsBack from './views/Informations'
import IndexInformation from './views/informations/index'
import CreateInformation from './views/informations/create'
import EditInformation from './views/informations/edit'

//download
import DownloadBack from './views/Download'
import IndexDownload from './views/downloads/index'
import CreateDownload from './views/downloads/create'
import EditDownload from './views/downloads/edit'

//assigment
import Assigment from './views/Assigment'
import IndexAssigment from './views/assigments/index'

//task category
import TaskCategory from './views/TaskCategories'
import IndexTaskCategory from './views/taskcategories/index'
import CreateTaskCategory from './views/taskcategories/create'
import EditTaskCategory from './views/taskcategories/edit'

//task
import Task from './views/Tasks'
import IndexTask from './views/tasks/index'
import CreateTask from './views/tasks/create'
import EditTask from './views/tasks/edit'

//jadwal
import Schedules from "./views/Schedules";
import IndexSchedule from './views/schedules/index'
import CreateSchedule from './views/schedules/create'
import EditSchedule from './views/schedules/edit'

const router = [
    {
        path:'/',
        component:FrontEnd,
        children:[
            {
                path:'',
                component:Home,
                name:'home'
            },
            {
                path:'profil',
                component:Profile,
                name:'profile'
            },
            {
                path:'informasi',
                component:Information,
                name:'information'
            },
            {
                path:'download',
                component:Download,
                name:'download'
            },
            {
                path:'kontak',
                component:ContactUs,
                name:'contact'
            },
            {
                path:'informasi/:slug',
                component:DetailInformation,
                name:'detailInformation'
            }
        ],
        meta:{
            auth:false
        }
    },
    {
        path:'/login',
        component:AdminAuth,
        children:[
            {
                path:'',
                component:Login,
                name:'login'
            }
        ],
        meta:{
            auth:false
        }
    },
    {
        path:'/admin',
        component:AdminContent,
        meta:{
            auth:true
        },
        children:[
            {
                path:'',
                component:Dashboard,
                name:'dashboard'
            },
            {
                path:'user',
                component:User,
                children:[
                    {
                        path:'',
                        component:IndexUser,
                        name:'indexUser'
                    },
                    {
                        path:'create',
                        component:CreateUser,
                        name:'createUser'
                    },
                    {
                        path:':id/edit',
                        component:EditUser,
                        name:'editUser'
                    },
                    {
                        path:'change-password',
                        component:ChangePassword,
                        name:'changePassword'
                    }
                ]
            },
            {
                path:'level-pengguna',
                component:UserLevel,
                children:[
                    {
                        path:'',
                        component:IndexUserLevel,
                        name:'indexUserLevel'
                    },
                    {
                        path:'create',
                        component:CreateUserLevel,
                        name:'createUserLevel'
                    },
                    {
                        path:':id/edit',
                        component:EditUserLevel,
                        name:'editUserLevel'
                    }
                ]
            },
            {
                path:'kontingen',
                component:Contingent,
                children:[
                    {
                        path:'',
                        component:IndexContingent,
                        name:'indexContingent'
                    },
                    {
                        path:'create',
                        component:CreateContingent,
                        name:'createContingent'
                    },
                    {
                        path:':id/edit',
                        component:EditContingent,
                        name:'editContingent'
                    }
                ]
            },
            {
                path:'jabatan',
                component:Position,
                children:[
                    {
                        path:'',
                        component:IndexPosition,
                        name:'indexPosition'
                    },
                    {
                        path:'create',
                        component:CreatePosition,
                        name:'createPosition'
                    },
                    {
                        path:':id/edit',
                        component:EditPosition,
                        name:'editPosition'
                    }
                ]
            },
            {
                path:'peserta',
                component:Participant,
                children:[
                    {
                        path:'',
                        component:IndexParticipant,
                        name:'indexParticipant'
                    },
                    {
                        path:'create',
                        component:CreateParticipant,
                        name:'createParticipant'
                    },
                    {
                        path:':id/edit',
                        component:EditParticipant,
                        name:'editParticipant'
                    }
                ]
            },
            {
                path:'information',
                component:InformationsBack,
                children:[
                    {
                        path:'',
                        component:IndexInformation,
                        name:'indexInformation'
                    },
                    {
                        path:'create',
                        component:CreateInformation,
                        name:'createInformation'
                    },
                    {
                        path:':id/edit',
                        component:EditInformation,
                        name:'editInformation'
                    }
                ]
            },
            {
                path:'download',
                component:DownloadBack,
                children:[
                    {
                        path:'',
                        component:IndexDownload,
                        name:'indexDownload'
                    },
                    {
                        path:'create',
                        component:CreateDownload,
                        name:'createDownload'
                    },
                    {
                        path:':id/edit',
                        component:EditDownload,
                        name:'editDownload'
                    }
                ]
            },
            {
                path:'kategori-penugasan',
                component:TaskCategory,
                children:[
                    {
                        path:'',
                        component:IndexTaskCategory,
                        name:'indexTaskCategory'
                    },
                    {
                        path:'create',
                        component:CreateTaskCategory,
                        name:'createTaskCategory'
                    },
                    {
                        path:':uuid/edit',
                        component:EditTaskCategory,
                        name:'editTaskCategory'
                    }
                ]
            },
            {
                path:'bidang-kegiatan',
                component:Task,
                children:[
                    {
                        path:'',
                        component:IndexTask,
                        name:'indexTask'
                    },
                    {
                        path:'create',
                        component:CreateTask,
                        name:'createTask'
                    },
                    {
                        path:':uuid/edit',
                        component:EditTask,
                        name:'editTask'
                    }
                ]
            },
            {
                path:'jadwal',
                component:Schedules,
                children:[
                    {
                        path:'',
                        component:IndexSchedule,
                        name:'indexSchedule'
                    },
                    {
                        path:'create',
                        component:CreateSchedule,
                        name:'createSchedule'
                    },
                    {
                        path:':uuid/edit',
                        component:EditSchedule,
                        name:'editSchedule'
                    }
                ]
            },
            {
                path:'penugasan',
                component:Assigment,
                children:[
                    {
                        path:'',
                        component:IndexAssigment,
                        name:'indexAssigment'
                    }
                ]
            }
        ]
    }

]


export default router