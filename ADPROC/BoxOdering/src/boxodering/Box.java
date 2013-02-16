/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package boxodering;

/**
 *
 * @author Todd Perry
 */
public abstract class Box {

    protected int grade;
    protected int id;
    protected double height;
    protected double width;
    protected double depth;
    protected boolean isSealable;

    public Box() {
    } //default constructor

    public Box(int grade, double height, double width, double depth, boolean isSealable) {
        this.grade = grade;
        this.height = height;
        this.width = width;
        this.depth = depth;
        this.isSealable = isSealable;
    }

    //mutator methods
    public void setGrade(int grade) {
        this.grade = grade;
    }

    public void setCol1() {
        //initlizes method for override
    }

    public void setCol2() {
        //initlizes method for override
    }

    public void setHeight(double height) {
        this.height = height;
    }

    public void setWidth(double width) {
        this.width = width;
    }

    public void setDepth(double depth) {
        this.depth = depth;
    }
    
    public void setSealable(boolean isSealable){
        this.isSealable = isSealable;
    }

    //access methods
    public int getGrade() {
        return grade;
    }

    public int getID() {
        return id;
    }

    public double getHeight() {
        return height;
    }

    public double getWidth() {
        return width;
    }

    public double getDepth() {
        return depth;
    }

    public String getCol1() {
        return "";
        //initilizes method for override
    }
    
    public String getCol2() {
        return "";
        //initilizes method for override
    }
    
    public boolean getSealable(){
        return isSealable;
    }

    protected double getSurfaceArea() {
        // A = 2hw + 2wd + 2hd
        double area = (2 * (height * width)) + (2 * (width * depth)) + (2 * (height * depth));
        return area;
    }

    public double getPrice() {
        //first get the price per square meter of the grade
        double pPerSqM = 0.0; //price per square meter
        if (grade == 1) {
            pPerSqM = 0.45;
        } else if (grade == 2) {
            pPerSqM = 0.59;
        } else if (grade == 3) {
            pPerSqM = 0.68;
        } else if (grade == 4) {
            pPerSqM = 0.92;
        } else if (grade == 5) {
            pPerSqM = 1.3;
        }
        double area = getSurfaceArea();
        double price = area * pPerSqM;
        return price;
    }

    protected double getMultiplier() {
        return 0.0;
        //overrides

    }

    protected double getMultiplier(double currentMultiplier) {
        //will only be called from sub classes, hence protected
        if (isSealable) {
            return currentMultiplier + 5;  //5% for sealable
        } else {
            return currentMultiplier;  // no extras, no multiplier
        }
    }
}
