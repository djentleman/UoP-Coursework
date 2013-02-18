package vysichart;

import java.util.Date;
import java.util.ArrayList;

/**
 *
 * @author Harry, Todd =======
 * @author UP619902, OtherID1, OtherID2
 */
public class Task {

    private String taskName, taskNumber;
    private int taskId;
    //The level of the task in the tree (the parent's level plus one).
    private int taskLevel;
    private Task taskParent;
    //An array of all nodes that need to be done before this task.
    private ArrayList<Task> dependentNodes;
    private ArrayList<Task> children; // tasks children
    private Date startDate, endDate, lateStart, lateEnd;
    private float taskDuration, taskSlack;
    private boolean taskIsComplete;

    public Task() {
        dependentNodes = new ArrayList<>(); // init
        children = new ArrayList<>(); // init
        taskIsComplete = false; // defaults
    } //Default constructor.

    public Task(String taskName) {
        this.taskName = taskName;
        dependentNodes = new ArrayList<>();
        children = new ArrayList<>();
        taskIsComplete = false; // defaults
    }

    public Task(String taskName, Task taskParent) {
        this.taskName = taskName;

        this.taskParent = taskParent;
        initParent(); // adds THIS as child to parent

        dependentNodes = new ArrayList<>();
        children = new ArrayList<>();
        
        taskIsComplete = false; // defaults
    }

    public Task(String taskName, Task taskParent,
            Date startDate, Date endDate) {

        this.taskName = taskName;
        this.taskParent = taskParent;
        this.dependentNodes = new ArrayList<>(); // init
        this.children = new ArrayList<>(); // init
        this.startDate = startDate;
        this.endDate = endDate;
        
        taskIsComplete = false; // defaults

        initParent(); // adds THIS as child to parent
    }

    public Task(String taskName, Task taskParent, ArrayList<Task> dependentNodes,
            Date startDate, Date endDate) {

        this.taskName = taskName;
        this.taskParent = taskParent;
        this.dependentNodes = dependentNodes; //  no need to init
        this.startDate = startDate;
        this.endDate = endDate;
        this.children = new ArrayList<>();

        initParent(); // adds THIS as child to parent
    }
    
    public void initParent(){
        this.taskParent.addChild(this); // fixes leakage
    }

    //Get methods for retrieving variable data
    public String getName() {
        return taskName;
    }

    public String getTaskNumber() {
        return taskNumber;
    }

    public int getTaskId() {
        return taskId;
    }

    public int getTaskLevel() {
        return taskLevel;
    }

    public Task getTaskParent() {
        return taskParent;
    }

    public ArrayList<Task> getDependentNodes() {
        return dependentNodes;
    }

    public ArrayList<Task> getChildren() {
        return children;
    }

    public Date getStartDate() {
        return startDate;
    }

    public Date getEndDate() {
        return endDate;
    }

    public Date getLateStart() {
        return lateStart;
    }

    public Date getLateEnd() {
        return lateEnd;
    }

    public float getTaskDuration() {
        return taskDuration;
    }

    //set methods for modifying class variables.
    public void setTaskName(String taskName) {
        this.taskName = taskName;
    }

    public void setTaskNumber(String taskNumber) {
        this.taskNumber = taskNumber;
    }

    /*Remove if not needed*/
    public void setTaskParent(Task taskParent) {
        this.taskParent = taskParent;
        this.taskParent.addChild(this); // adds THIS as child to parent
    }

    public void setTaskDuration(int taskDuration) {
        this.taskDuration = taskDuration;
    }

    public void setTaskSlack(int taskSlack) {
        this.taskSlack = taskSlack;
    }

    public void setTaskIsComplete(boolean taskIsComplete) {
        this.taskIsComplete = taskIsComplete;
    }

    //--- 'Utility' methods ---
    
    public void printOut() { // just a console printout for debugging
        System.out.println("Task Name: " + taskName);
        if (taskParent != null) {
            System.out.println("Parent: " + taskParent.getName());
        } else {
            System.out.println("No Parent");
        }
        System.out.println("Depedent Nodes:");
        if (dependentNodes.isEmpty()) {
            System.out.println("    None");
        } else {
            for (Task currentTask : dependentNodes) {
                System.out.println("    " + currentTask.getName());
            }
        }
        System.out.println("Children:");
        if (children.isEmpty()) {
            System.out.println("    None");
        } else {
            for (Task currentTask : children) {
                System.out.println("    " + currentTask.getName());
            }
        }
    }

    public void addDependantNode(Task task) {
        dependentNodes.add(task); // adds a node to the dependant node array
    }

    public void removeDependentNode(Task taskToRemove) {
        dependentNodes.remove(taskToRemove); // removes a node from the dependant node aray
        // this will need validation in future
    }

    public void addChild(Task task) {
        children.add(task); // adds a node to the child array
    }

    public void removeChild(Task taskToRemove) {
        children.remove(taskToRemove); // removes a child from the child array
    }

    public void changeParent(Task newParent) {
        // 'cut ties' with old parent
        this.taskParent.removeChild(this);
        // set new parent
        setTaskParent(newParent);
        //setTaskParent automatically adds THIS as child
    }
    
    public String getString(){
        // string interpretation of task
        //taskname, taskNumber already string
        //String idStr = String.valueOf(taskId);
        //String levelStr = String.valueOf(taskLevel);
        // store parent ID
        //String parentStr = String.valueOf(taskParent.getTaskId());
        //String dependentStr = "";
        //for (Task currentTask : dependentNodes){
        //    dependentStr += String.valueOf(currentTask.getTaskId()); // stores IDs
        //    dependentStr += " "; // seperated by spaces
        //}
        
        //String childStr = "";
        //for (Task currentTask : children){
        //    childStr += String.valueOf(currentTask.getTaskId()); // stores IDs
        //    childStr += " "; // seperated by spaces
        //}
        
        //String strtStr = String.valueOf(startDate);
        //String endStr = String.valueOf(endDate);
        //String lateStartStr = String.valueOf(lateStart);
        //String lateEndStr = String.valueOf(lateEnd);
        
        //String durationStr = String.valueOf(taskDuration);
        //String slackStr = String.valueOf(taskSlack);
        
        //String completeStr = String.valueOf(taskIsComplete);
        
        
        //String str = taskName + "\n" + taskNumber + "\n" +  idStr + "\n" + levelStr + 
        //        "\n" + parentStr + "\n" + dependentStr + "\n" + childStr + "\n" + strtStr + 
        //        "\n" + endStr + "\n" + lateStartStr + "\n" + lateEndStr + "\n" + 
        //        durationStr + "\n" + slackStr + "\n" + completeStr;
        
        String str = taskName;
        return str;
    }
}