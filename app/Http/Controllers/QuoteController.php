<?php

namespace App\Http\Controllers;
use App\Models\Quote;
use App\Models\Author;
use Illuminate\Http\Request;
use App\Events\QuoteCreated;
use Illuminate\Support\Facades\Event;
use App\Models\QuoteLog;
use App\Models\AuthorLog;
use App\Listeners\Mail;
class QuoteController extends Controller
{
public function getIndex($author=null)
 {
//  $quotes = Quote::all();
//  return view('quote.index',compact('quotes'));

if(!is_null($author)){
   $quote_author = Author::where('name',$author)->first();
   if($quote_author){
      $quotes = $quote_author->quotes()->orderBy('created_at','desc')->paginate(6);
   }
}else{
   $quotes = Quote::orderBy('created_at','desc')->paginate(6);
}
return view('quote.index',['quotes' => $quotes]);
        
 }
 
 public function postQuote(Request $request)
 {

   $this->validate($request,[
      'author' => 'required|max:60',
      'quote' => 'required|max:500',
      'email' => 'required|email'
      ]);
        
        
 $authorText = ucfirst($request['author']);
 $quoteText =  $request['quote'];
 $author = Author::where('name',$authorText)->first();
 if(!$author){
 $author= new Author();
 $author->name = $authorText;
 $author->email = $request['email'];
 $author->save();
 }
 $quote = new Quote();
 $quote->quote = $quoteText;
 $author->quotes()->save($quote);
 Event::dispatch(new QuoteCreated($author));
 return redirect()->route('index')->with([
 'success' => 'Quote Saved !'
 ]);
 }

 public function getMailCallback($author_name)
 {
// $message->attach(asset('images/logo.png'));  
 $author_log = new AuthorLog();
 $author_log->author = $author_name;
 $author_log->save();
 
 return view('email.callback',['author'=>$author_name]);
 }

 public function deleteQuote($quote_id)
 {
 $quote = Quote::find($quote_id);
 $author_deleted = false;
 if(count($quote->author->quotes) === 1){
 $quote->author->delete();
 $author_deleted = true;
 }
 $quote->delete();
 $msg = $author_deleted ? 'Quote and author deleted' : 'Quote deleted ';
 return redirect()->route('index')->with(['success'=> $msg]);
 }

}
