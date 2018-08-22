<?php
class User
{
	private $_session_name, $_isLoggedIn, $_activeRecord, $_error, $_db, $_online;


	public function __construct($user = null){
		$this->_db = DB::getInstance();
		$this->_activeRecord = new ActiveRecord('users');
		$this->_session_name = Config::get('session/session_name');

		if(!$user){
				if(Session::exists($this->_session_name)){
						$user = Session::get($this->_session_name);
						if($this->_activeRecord->find($user))
						{
								$this->_isLoggedIn = true;
								
						}
				}

		}
		else{
				$this->_activeRecord->find($user);
		}
}

public static function tableName(){
		return 'users';
	}

		public function activeRecord(){
			return $this->_activeRecord;
		}

		public function login($username = null, $password = null, $remember= false)
		{	
			if(!$username && !$password && $this->exists())
			{
					Session::put($this->_session_name, $this->_activeRecord->getId());
			}
			else{

						if($this->_activeRecord->find($username)){
								if( Hash::make($password,$this->_activeRecord->data()->salt)  === $this->_activeRecord->data()->password)
								{
										Session::put($this->_session_name, $this->_activeRecord->getId());
                                        Session::put($this->_online, 1);
                                        $this->activeRecord()->update([
                                           'online' =>  1
                                        ]);

				if($remember){
					$hash  = Hash::unique();
					$hashCheck = $this->_db->get('users_session',['user_id', '=', $this->_activeRecord->getId()]); 
				
					if(!$hashCheck->counter()){
						$this->_db->insert('users_session', [
							'user_id' => $this->_activeRecord->getId(),
							'hash' => $hash
							]);
					}else{
						$hash = $hashCheck->first()->hash;
					}

					Cookie::put(Config::get('remember/cookie_name')	, $hash, Config::get('remember/cookie_expiry'));
				}

										return true;
								}
								else{
									$this->_error .= 'Incorrect Password';
									return false;
								}
						}
						else{
							$this->_error = 'Incorrect Username, Please sign-up if you haven\'t!';
							return false;
						}

			}


	}

	public function logout(){
		$this->_db->delete('users_session',['user_id', '=', $this->_activeRecord->getId()]);
		Session::delete(Config::get('session/session_name'));
		Cookie::delete(Config::get('remember/cookie_name'));
        $this->activeRecord()->update([
            'online' =>  0
        ]);

	}

	public function errors(){
		return $this->_error;
	}
	public function exists(){
		return (!empty($this->_activeRecord->data()))? true: false;
	}

	public function isLoggedIn(){
		return $this->_isLoggedIn;
	}


		public function isStudent(){
		if($this->_activeRecord->data()->user_type == 4)
		{
			return true;
		}

}
		public function isModerator(){
		if($this->_activeRecord->data()->user_type == 2)
		{
			return true;
		}

}


	public function isAdmin(){
		if($this->_activeRecord->data()->user_type == 1)
		{
			return true;
		}

	}

	public function getUsers(){
		return $this->_activeRecord->read()->results();
	}

	public function deleteUser(){

	    $all_topics = $this->_activeRecord->hasMany(Topic::tableName(),['creator_id' =>  $this->_activeRecord->getId()]);
        $all_questions = $this->_activeRecord->hasMany(Questions::tableName(),['author_id' =>  $this->_activeRecord->getId()]);
        $all_threads = $this->_activeRecord->hasMany(Threads::tableName(),['creator_id'   =>  $this->_activeRecord->getId()]);
        $all_posts = $this->_activeRecord->hasMany(Post::tableName(),['creator_id' =>  $this->_activeRecord->getId()]);
        $all_votes = $this->_activeRecord->hasMany(Votes::tableName(),['user_id'   =>  $this->_activeRecord->getId()]);
        $all_reply = $this->_activeRecord->hasMany(ThreadsReply::tableName(),['creator_id'   =>  $this->_activeRecord->getId()]);
        $all_thread_votes = $this->_activeRecord->hasMany(ThreadsVote::tableName(),['user_id'   =>  $this->_activeRecord->getId()]);
        $all_thread_reply = $this->_activeRecord->hasMany(ThreadsReply::tableName(),['creator_id'   =>  $this->_activeRecord->getId()]);

        $chat_event = new ChatEvent();
        $chat_event->deleteWhere(['user1'    =>  $this->_activeRecord->getId()]);
        $chat_event->deleteWhere(['user2'    =>  $this->_activeRecord->getId()]);


        $chat = new Chat();
        $chat->deleteWhere(['user1'    =>  $this->_activeRecord->getId()]);
        $chat->deleteWhere(['user2'    =>  $this->_activeRecord->getId()]);




        foreach ($all_thread_votes as $thread_vote){

            $votes = new ThreadsVote();
            $votes->activeRecord()->relate(['id'    =>  $thread_vote->id]);
            $votes->delete();
        }
        foreach ($all_thread_reply as $thread_replies){

            $reply = new ThreadsReply();
            $reply->activeRecord()->relate(['id'    =>  $thread_replies->id]);
            $reply->delete();
        }



        foreach ($all_votes as $vote){

            $votes = new Votes();
            $votes->activeRecord()->relate(['id'    =>  $vote->id]);
            $votes->delete();
        }
        foreach ($all_reply as $replies){

            $reply = new Reply();
            $reply->activeRecord()->relate(['id'    =>  $replies->id]);
            $reply->delete();
        }


        foreach ($all_topics as $topic){

            $topics = new Topic();
            $topics->activeRecord()->relate(['id'   =>  $topic->id]);
            $topics->delete();

        }
        foreach ($all_questions as $question){

            $questions = new Questions();
            $questions->activeRecord()->relate(['id'   =>  $question->id]);
            $questions->delete();

        }


        foreach ($all_threads as $thread){

            $threads = new Threads();
            $threads->activeRecord()->relate(['id'    =>  $thread->id]);
            $threads->delete();
        }

        foreach ($all_posts as $post){

            $posts = new Post();
            $posts->activeRecord()->relate(['id'    =>  $post->id]);
            $posts->delete();
        }






        $this->_activeRecord->delete(['id'  =>  $this->_activeRecord->getId()]);

    }


}


?>