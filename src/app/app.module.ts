import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { AngularFirestoreModule } from '@angular/fire/firestore';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { EditorComponent } from './editor/editor.component';
import { AngularFireModule } from '@angular/fire';
import { AngularFirestore } from 'angularfire2/firestore';
import { FormsModule } from '@angular/forms';

@NgModule({
  declarations: [
    AppComponent,
    EditorComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    AngularFireModule.initializeApp({
    apiKey: "AIzaSyDwL4neN5HlJsY2lF3cb6PKHp6xCSv72Rc",
    authDomain: "whiteboard-17686.firebaseapp.com",
    databaseURL: "https://whiteboard-17686.firebaseio.com",
    projectId: "whiteboard-17686",
    storageBucket: "whiteboard-17686.appspot.com",
    messagingSenderId: "768541329799",
    appId: "1:768541329799:web:53f4c4af7a7ea0bcf56b22",
    measurementId: "G-068X0WR1SW"}),
    FormsModule,
  ],
  providers: [ AngularFireModule, AngularFirestore ],
  bootstrap: [AppComponent]
})
export class AppModule { }
