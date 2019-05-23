import Vue from 'vue'
import Vuex from 'vuex'
import BaseStore from './Base/'
import UserStore from './UserStore'
import UserLevelStore from './UserLevelStore'
import PositionStore from './PositionStore'
import ContingentStore from './ContingentStore'
import ParticipantStore from './ParticipantStore'
import InformationStore from './InformationStore'
import DownloadStore from './DownloadStore'
import TaskCategoriesStore from './TaskCategoriesStore'
import TasksStore from './TasksStore'
import SchedulesStore from './SchedulesStore'
import ParticipantTasksStore from './ParticipantTasksStore'

Vue.use(Vuex)

export default new Vuex.Store({
  modules:{
    'BaseStore':BaseStore,
    'UserStore':UserStore,
    'UserLevelStore':UserLevelStore,
    'PositionStore':PositionStore,
    'ContingentStore':ContingentStore,
    'ParticipantStore':ParticipantStore,
    'InformationStore':InformationStore,
    'DownloadStore':DownloadStore,
    'TaskCategoriesStore':TaskCategoriesStore,
    'TasksStore':TasksStore,
    'SchedulesStore':SchedulesStore,
    'ParticipantTasksStore':ParticipantTasksStore
  }
})
