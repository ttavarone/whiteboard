import { Component } from '@angular/core';
import { AngularFirestore, AngularFirestoreCollection } from 'angularfire2/firestore';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'whiteboard';
  private taskTitle: String;
  private taskPriority: any;


	constructor(private afs: AngularFirestore){}

	ngOnInit(){	
		this.getTask();

	}

	getTask(){
      var taskRef = this.afs.collection('tasks-incomplete').doc("O9cpzjV7UDVrIY3bzkFS");
      var task = taskRef.get().subscribe(snapshot => {
          //console.log(snapshot);
          this.taskTitle = snapshot.get('title');
          this.taskPriority = snapshot.get('priority');
          //this.setValues(this.taskTitle, this.taskPriority);
          });
  	}

  	setValues(taskTitleIn, taskPriorityIn){

  		console.log(taskTitleIn);
  	}
}
