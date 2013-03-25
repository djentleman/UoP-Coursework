-- 
-- 
-- MATHFUN - DISCRETE MATHEMATICS AND FUNCTIONAL PROGRAMMING
-- Functional Programming Assignment, 2012/13
-- UP612136
--

-- --
----Types----
-- --

data Film = Film String [String] Int [String] -- Title, Cast, Year, Fans
                 deriving (Eq, Ord, Show, Read)


-- --
----Functional Code----
-- --

filmExists :: String -> [Film] -> Bool
filmExists _ [] = False
filmExists filmName ((Film name _ _ _):films)
    |filmName == name = True || filmExists filmName films
    |otherwise = False || filmExists filmName films
    

addNewFilm :: Film -> [Film] -> [Film]
addNewFilm filmToAdd films = filmToAdd : films

isYear :: Int -> Film -> Bool
isYear year (Film _ _ filmYear _)
    |year == filmYear = True
    |otherwise = False

getFilmsByYear year = filter (isYear year) -- filters for year

isFan :: String -> Film -> Bool
isFan person (Film _ _ _ []) = False
isFan person (Film name actors year (fan:fans))
    |person == fan = True
    |otherwise = (isFan person (Film name actors year fans))

getFilmsByFan person = filter (isFan person)



afterYear :: Int -> Film -> Bool
afterYear year (Film _ _ filmYear _) -- did the film come out after the year
    |year <= filmYear = True
    |otherwise = False

beforeYear :: Int -> Film -> Bool
beforeYear year (Film _ _ filmYear _) -- did the film come out before the year
    |year >= filmYear = True
    |otherwise = False

hasActor :: String -> Film -> Bool
hasActor _ (Film _ [] _ _) = False
hasActor filmActor (Film name (actor:actors) year fans)
    |filmActor == actor = True
    |otherwise = hasActor filmActor (Film name actors year fans)

inPeriod before after actor = filter (beforeYear before) . filter (afterYear after) . filter (hasActor actor)
-- film is inPeriod is it's beforeYear before, and afterYear after


-- fanName, filmName, films
becomeFan :: String -> String -> [Film] -> [Film]
becomeFan _ _ [] = []
becomeFan fanName filmName ((Film name actors year fans):films)
    |filmName == name = (Film name actors year (fanName:fans)) : (becomeFan fanName filmName films)
    |otherwise = (Film name actors year fans) : (becomeFan fanName filmName films) -- no change

getNumberOfFans :: Film -> Int
getNumberOfFans (Film _ _ _ []) = 0
getNumberOfFans (Film name actors year (fan:fans)) = 1 + getNumberOfFans (Film name actors year fans)

getFilmWithMostFans :: [Film] -> Film -> Film -- dirty code, will need to rebuild
getFilmWithMostFans [] currentBest = currentBest
getFilmWithMostFans (film:films) currentBest
    |(getNumberOfFans film) > (getNumberOfFans currentBest) = getFilmWithMostFans films film
    |otherwise = getFilmWithMostFans films currentBest

getBestFilm :: [Film] -> Film -- dirty code, will need to rebuild
getBestFilm (film:films) = getFilmWithMostFans films film -- calls above function

reverseList :: [a] -> [a] -- reverses list -- polymorphic
reverseList [] = []
reverseList (x:xs) = (reverseList xs) ++ [x]

-- originalFilms (the array that gets filtered) -- -- current iteration -- output
-- dirty, prefreabley [Film] -> [Film]
filterTopFilm :: [Film] -> [Film] -> [Film]
filterTopFilm _ [] = []
filterTopFilm originalFilms (film:films)
	|getBestFilm originalFilms == film = filterTopFilm originalFilms films
	|otherwise = film : filterTopFilm originalFilms films

-- get top n films
-- count -> filmList -> topFilms -> output
-- top of list = number 1
-- bottom of list = number 5 :D
getTopNFilms :: Int -> [Film] -> [Film] -> [Film]
getTopNFilms 0 _ topFilms = topFilms
getTopNFilms count allFilms topFilms = (getTopNFilms (count - 1)) (filterTopFilm allFilms allFilms) (getBestFilm allFilms:topFilms)

getTopFive :: [Film] -> [Film]
getTopFive films = getTopNFilms 5 films []







-- --
----Interface Code----
-- --


loadFilms :: IO [Film]
loadFilms = do
    filmStr <- readFile "films.txt"
    let films = (read filmStr :: [Film])
    putStrLn "Films Loaded!"
    return films

saveFilms :: [Film] -> IO ()
saveFilms films = do
    writeFile "films.txt" (show films)
    putStrLn "Films Saved!"
    

welcome :: [Film] -> IO ()
welcome films = do
    putStrLn "Please Enter Your Name"
    putStr ">>>"
    userName <- getLine
    putStrLn ""
    putStrLn "#########################"
    putStr "    Welcome   "
    putStrLn userName
    putStrLn "#########################"
    menu films userName


--input = String, output = IO function
getMenuChoice :: String -> [Film] -> String -> IO () -- string used as opposed to Int for robustness
getMenuChoice "1" films userName = addFilm films userName
getMenuChoice "2" films userName = viewAllFilms films userName
getMenuChoice "3" films userName = viewFilmsByYear films userName
getMenuChoice "4" films userName = viewFilmsByFan films userName
getMenuChoice "5" films userName = viewFilmsFromPeriod films userName
getMenuChoice "6" films userName = becomeFanOfFilm films userName
getMenuChoice "7" films userName = printTopFilm films userName
getMenuChoice "8" films userName = printTopFive films userName
getMenuChoice "9" films _ = exit films 
getMenuChoice _ films userName = invalidChoice films userName



menu :: [Film] -> String -> IO ()
menu films userName = do
    putStrLn " ##############"
    putStrLn " #PORT SOLENT#"
    putStrLn " #FILM SYSTEM#"
    putStrLn " ##############"
    putStrLn "(not related to year 1 java in any way!)"
    putStrLn ""
    putStrLn "#-#-#-#-#-#- MENU SYSTEM -#-#-#-#-#-#"
    putStrLn "Press 1 To Add A Film"
    putStrLn "Press 2 To View All Films"
    putStrLn "Press 3 To Display All Films From A Certain Year"
    putStrLn "Press 4 To Display All Films A User Is A Fan Of"
    putStrLn "Press 5 To Display All Films With A Selected Actor Released Within A Peticular Period"
    putStrLn "Press 6 To Say You're A Fan Of A Peticular FIlm"
    putStrLn "Press 7 To Display The Best Film By A Particular Actor"
    putStrLn "Press 8 To Display The Top 5 FIlms"
    putStrLn "Press 9 To Exit"
    putStr ">>>"
    choice <- getLine
    getMenuChoice choice films userName

invalidChoice :: [Film] -> String -> IO ()
invalidChoice films userName = do
    putStrLn "Invalid Menu Choice"
    pressEnter films userName

-------------ADD FILM-----------------

addFilm :: [Film] -> String -> IO ()
addFilm films userName = do
    title <- getTitle -- would you 'let', but not printing anything
    actors <- getActors []
    releaseYear <- getReleaseYear
    fans <- getFans []
    let film = Film title actors releaseYear fans
    if (filmExists title films) == True
        then do putStrLn "Film Already Exists; Film Will Not Be Added"
                pressEnter films userName
        else do let filmsToSave = addNewFilm film films -- filmsToSave is new Films
                putStrLn "Film Has Been Added!" 
                pressEnter filmsToSave userName

getTitle :: IO String
getTitle = do
    putStrLn "Enter Film Title"
    putStr ">>>"
    title <- getLine
    return title

getActors :: [String] -> IO [String]
getActors actors = do
    putStrLn "Enter Actor Name (enter empty string to finish entering actors)"
    putStr ">>>"
    actorToAdd <- getLine
    if actorToAdd == ""
        then return actors
        else do getActors (actorToAdd : actors)

getReleaseYear :: IO Int
getReleaseYear = do
    putStrLn "Enter Year Of Release"
    putStr ">>>"
    releaseYear <- getLine
    return (read releaseYear :: Int)

getFans :: [String] -> IO [String]
getFans fans = do
    putStrLn "Enter Fan Name (enter empty string to finish entering fans)"
    putStr ">>>"
    fanToAdd <- getLine
    if fanToAdd == ""
        then return fans
        else do getFans (fanToAdd : fans)
    

--------------VIEW ALL FILMS---------------

viewAllFilms :: [Film] -> String -> IO ()
viewAllFilms films userName = do
    putStrLn "List Of Films:"
    listFilms films
    pressEnter films userName

listFilms :: [Film] -> IO ()
listFilms (film:films) = do
    filmPrintOut film
    if films == []
        then return ()
        else do listFilms films

-------------------VIEW FILMS BY YEAR------------


viewFilmsByYear :: [Film] -> String -> IO ()
viewFilmsByYear films userName = do
    putStrLn "Enter A Year To Search"
    putStr ">>>"
    year <- getLine
    let filmsByYear = getFilmsByYear (read year ::	Int) films
    if filmsByYear == []
        then do putStrLn "No Films Found"
                pressEnter films userName
        else do listFilms filmsByYear
                pressEnter films userName

--------------------VIEW FILMS BY FAN--------------------------

viewFilmsByFan :: [Film] -> String -> IO ()
viewFilmsByFan films userName = do
    let filmsByFan = getFilmsByFan userName films
    if filmsByFan == []
        then do putStrLn "No Films Found"
                pressEnter films userName
        else do listFilms filmsByFan
                pressEnter films userName
    pressEnter films userName

-------------VIEW FILMS WITH A CERTAIN ACTOR FROM A CERTAIN PERIOD--------

viewFilmsFromPeriod :: [Film] -> String -> IO ()
viewFilmsFromPeriod allFilms userName = do
    putStrLn "Enter The First (Lower) Boundry:"
    putStr ">>>"
    after <- getLine
    putStrLn "Enter The Second (Higher) Boundry:"
    putStr ">>>"
    before <- getLine
    putStrLn "Enter The Actor:"
    putStr ">>>"
    actor <- getLine
    let filmsByPeriod = inPeriod (read before :: Int) (read after :: Int) actor allFilms
    if filmsByPeriod == []
        then do putStrLn "No Films Found"
                pressEnter allFilms userName
        else do listFilms filmsByPeriod
                pressEnter allFilms userName

-------------STATE YOU'RE A FAN OF A CERTAIN FILM-----------------

becomeFanOfFilm :: [Film] -> String -> IO ()
becomeFanOfFilm films userName = do
    putStrLn "Enter The Name Of The Film You Want To Become A Fan Of:"
    putStr ">>>"
    filmName <- getLine
    if filmExists filmName films -- use isFan to validate for fans
        then do let updatedFilms = becomeFan userName filmName films
                putStr userName
                putStr " Is Now A Fan Of "
                putStrLn filmName
                pressEnter updatedFilms userName
        else do putStrLn "Film Does Not Exist"
                pressEnter films userName
                
    
--------------------PRINT 'TOP' FILM------------------------------


printTopFilm :: [Film] -> String -> IO ()
printTopFilm films userName = do
    putStrLn "Enter Actor:"
    putStr ">>>"
    actor <- getLine
    let filmsByActor = filter (hasActor actor) films
    let bestFilm = getBestFilm filmsByActor
    putStrLn "Best Film:"
    filmPrintOut bestFilm
    pressEnter films userName

	
-----------------PRINT TOP 5 FILMS------------------------------------
	
	
printTopFive :: [Film] -> String -> IO ()
printTopFive films userName = do
    putStrLn "Top 5 Films"
    let topFiveFilms = reverseList (getTopFive films)
    listFilmsInOrder 1 topFiveFilms
    pressEnter films userName

	
	
listFilmsInOrder :: Int -> [Film] -> IO ()
listFilmsInOrder count (film:films) = do
    putStr (show count)
    putStrLn "."
    filmPrintOut film
    if films == []
        then return ()
        else do listFilmsInOrder (count + 1) films
    


--------------PRESS ENTER TO CONTINUTE---------------------------

pressEnter :: [Film] -> String -> IO () -- allows a break before menu refresh
pressEnter films userName = do
    putStrLn "Press Enter To Continue"
    putStr ">>>"
    ln <- getLine
    menu films userName



--------------FILM PRINT OUT----------------------------------

filmPrintOut :: Film -> IO ()
filmPrintOut (Film title actors releaseYear fans) = do
    putStrLn "--------------------"
    printTitle title
    putStr "Starring: "
    printStringArray actors
    putStrLn "" -- new line
    printReleaseYear releaseYear
    printNumberOfFans (Film title actors releaseYear fans)
    putStrLn "" -- new line

printTitle :: String -> IO ()
printTitle title = do
    putStr "Title: "
    putStrLn title

printStringArray :: [String] -> IO () -- general 'string printer'
printStringArray (str:strs) = do
    putStr str
    putStr ", "
    if strs == []
        then return ()
        else do printStringArray strs

printReleaseYear :: Int -> IO ()
printReleaseYear year = do
    putStr "Release Year: "
    putStrLn (show year)

printNumberOfFans :: Film -> IO () -- takes in a film, returns number of fans
printNumberOfFans film = do
    putStr "Fans: "
    let noOfFans = (getNumberOfFans film)
    putStrLn (show noOfFans)
    


---------------------------------------------------------------


-- --
----Main----
-- --

-- the films loads on program start
-- the films are passed around (and modified) by the program
-- when the program is exited, the (modified) films save


-- STARTS
main :: IO ()
main = do
    films <- loadFilms -- 'films' holds the String from the text file
    welcome films
    --menu films

-- ENDS
exit :: [Film] -> IO ()
exit films = do -- perhaps before saving, push though the whole file so it can close
    saveFilms films -- saves 'films'
    putStrLn "Thank You For Using The Program"
    putStrLn "Please Use It Again! :D"


-- --
----Demo Information----
-- --



-- Demo function to test basic functionality (without persistence - i.e.
-- testDatabase doesn't change and nothing is saved/loaded to/from file).



demo :: Int -> IO ()
--demo 1 = putStrLn all films after adding 2013 film "The Great Gatsby"
-- starring "Leonardo DiCaprio" and "Tobey Maguire" to testDatabase
demo 1 = listFilms (addNewFilm (Film "The Great Gatsby" ["Leonardo DiCaprio", "Tobey Maguire"] 2013 ["Todd"]) (testDatabase))
--demo 2 = putStrLn (fnToTurnAListOfFilmsIntoAMultiLineString testDatabase)
demo 2 = listFilms testDatabase
--demo 3 = putStrLn all films from 2012
demo 3 = listFilms (getFilmsByYear 2012 testDatabase)
--demo 4 = putStrLn all films that "Zoe" is a fan of
demo 4 = listFilms (getFilmsByFan "Zoe" testDatabase)
--demo 5 = putStrLn all "Tom Hanks" films from 2000 until 2011
demo 5 = listFilms (inPeriod 2011 2000 "Tom Hanks" testDatabase)
--demo 6 = putStrLn all films after "Zoe" becomes fan of "Forrest Gump"
demo 6 = listFilms (becomeFan "Zoe" "Forrest Gump" testDatabase)
--demo 61 = putStrLn all films after "Zoe" becomes fan of "Inception"
demo 61 = listFilms (becomeFan "Zoe" "Inception" testDatabase)
--demo 7 = putStrLn best "Tom Hanks" film
demo 7 = filmPrintOut (getBestFilm (filter (hasActor "Tom Hanks") testDatabase))
--demo 8 = putStrLn top 5 films
demo 8 = listFilmsInOrder 5 (getTopFive testDatabase)
-- catch all
demo _ = putStrLn "Invalid Input"

-- --
----Test Data----
-- --

testDatabase :: [Film]
testDatabase = [
    (Film
        "Casino Royale"
        ["Daniel Craig", "Eva Green", "Judi Dench"]
        2006
        ["Garry", "Dave", "Zoe", "Kevin", "Emma"]),
    (Film
        "Cowboys & Aliens"
        ["Harrison Ford", "Daniel Craig", "Olivia Wilde"]
        2011
        ["Bill", "Jo", "Garry", "Kevin", "Olga", "Liz"]),
    (Film
        "Catch Me If You Can"
        ["Leonardo DiCaprio", "Tom Hanks"]
        2002
        ["Zoe", "Heidi", "Jo", "Emma", "Liz", "Sam", "Olga", "Kevin", "Tim"]),
    (Film
        "Mamma Mia!"
        ["Meryl Streep", "Pierce Brosnan"]
        2008
        ["Kevin", "Jo", "Liz", "Amy", "Sam", "Zoe"]),
    (Film
        "Saving Private Ryan"
        ["Tom Hanks", "Matt Damon"]
        1998
        ["Heidi", "Jo", "Megan", "Olga", "Zoe", "Wally"]),
    (Film
        "Life of Pi"
        ["Suraj Sharma"]
        2012
        ["Kevin", "Olga", "Liz", "Tim", "Zoe", "Paula", "Jo", "Emma"]),
    (Film
        "Titanic"
        ["Leonardo DiCaprio", "Kate Winslet"]
        1997
        ["Zoe", "Amy", "Heidi", "Jo", "Megan", "Olga"]),
    (Film
        "Quantum of Solace"
        ["Daniel Craig", "Judi Dench"]
        2008
        ["Bill", "Olga", "Tim", "Zoe", "Paula"]),
    (Film
        "You've Got Mail"
        ["Meg Ryan", "Tom Hanks"]
        1998
        ["Dave", "Amy"]),
    (Film
        "Collateral"
        ["Tom Cruise", "Jamie Foxx"]
        2004
        ["Dave", "Garry", "Megan", "Sam", "Wally"]),
    (Film
        "The Departed"
        ["Leonardo DiCaprio", "Matt Damon", "Jack Nicholson"]
        2006
        ["Zoe", "Emma", "Paula", "Olga", "Dave"]),
    (Film
        "Inception"
        ["Leonardo DiCaprio"]
        2010
        ["Chris", "Emma", "Jo", "Bill", "Dave", "Liz", "Wally", "Zoe", "Amy", "Sam", "Paula", "Kevin", "Olga"]),
    (Film
        "Up in the Air"
        ["George Clooney", "Vera Farmiga"]
        2009
        ["Wally", "Liz", "Kevin", "Tim", "Emma"]),
    (Film
        "The Shawshank Redemption"
        ["Tim Robbins", "Morgan Freeman"]
        1994
        ["Jo", "Wally", "Liz", "Tim", "Sam", "Zoe", "Emma", "Garry", "Olga", "Kevin"]),
    (Film
        "Gladiator"
        ["Russell Crowe", "Joaquin Phoenix"]
        2000
        ["Garry", "Ian", "Neal"]),
    (Film
        "The King's Speech"
        ["Colin Firth", "Geoffrey Rush"]
        2010
        ["Garry", "Megan", "Sam", "Ian", "Bill", "Emma", "Chris"]),
    (Film
        "The Descendants"
        ["George Clooney"]
        2011
        ["Wally", "Liz", "Kevin", "Tim", "Emma", "Chris", "Megan"]),
    (Film
        "Cloud Atlas"
        ["Tom Hanks", "Halle Berry"]
        2012
        ["Dave", "Amy", "Garry", "Ian", "Neal"]),
    (Film
        "The Reader"
        ["Kate Winslet", "Ralph Fiennes"]
        2008
        ["Emma", "Bill", "Dave", "Liz"]),
    (Film
        "Minority Report"
        ["Tom Cruise"]
        2002
        ["Dave", "Garry", "Megan", "Sam", "Wally"]),
    (Film
        "Revolutionary Road"
        ["Leonardo DiCaprio", "Kate Winslet"]
        2008
        ["Wally", "Sam", "Dave", "Jo"]),
    (Film
        "Forrest Gump"
        ["Tom Hanks"]
        1994
        ["Ian", "Garry", "Bill", "Olga", "Liz", "Sam", "Dave", "Jo", "Chris", "Wally", "Emma"]),
    (Film
        "Larry Crowne"
        ["Tom Hanks", "Julia Roberts"]
        2011
        ["Liz", "Wally"]),
    (Film
        "The Terminal"
        ["Tom Hanks", "Catherine Zeta Jones"]
        2004
        ["Olga", "Heidi", "Bill", "Sam", "Zoe"]),
    (Film
        "Django Unchained"
        ["Jamie Foxx", "Leonardo DiCaprio", "Christoph Waltz"]
        2012
        ["Kevin", "Tim", "Emma", "Olga" ])
    ]